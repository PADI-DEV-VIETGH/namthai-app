<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AppSaleController extends Controller
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('BASE_URL');
    }

    public function login()
    {
        return view('app_sale.login');
    }

    public function postLogin(Request $request)
    {
        $option['base_url'] = $this->baseUrl;
        $credentials = $request->only(['phone_number', 'password']);
        $params = [
            'credential' => [
                'phone_number' => $credentials['phone_number'],
                'password' => $credentials['password'],
            ],
            'device' => [
                "uid" => "employee_18",
                "model" => "HTC One (M8)",
                "os" => "android",
                "os_version" => "android 8.0",
                "app_version" => "1.0",
                "onesignal_player_id" => "aaaaaaaaa"
            ]
        ];

        $this->setOptions($option);
        $dataLogin = $this->post('api/v1/sale/auth/login', $params);

        if (isset($dataLogin['status']) && $dataLogin['status'] == 200) {
            session()->put('dataLogin', $dataLogin['data']);
            session()->save();

            return redirect()->route('app_sale.home');
        }

        return redirect()->back()->withInput($request->input())->withErrors(['message_error' => $dataLogin['error']['message'] ?? $dataLogin['data']['message']]);

    }

    public function postLogout(Request $request)
    {
        $request->session()->flush();

        return redirect()->route('app_sale.login');

    }

    public function home(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $dataCheckIn = session()->get('dataCheckIn');

        return view('app_sale.home_not_checkin', compact('dataLogin', 'dataCheckIn'));
    }

    public function listWorkingPlan(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $page = $request->get('page') ?? 1;
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);

        $params = [
            'page' => $page,
            'length' => 100
        ];

        $listWorkingPlan = $this->get('api/v1/workingPlans', $params, $header);

        if ($listWorkingPlan['status'] == 200) {
            $listWorkingPlan = $listWorkingPlan['data']['results'];

            return view('app_sale.list_working_plan', compact('listWorkingPlan'));
        }
    }

    public function checkIn(Request $request)
    {
        return view('app_sale.checkin');
    }

    public function productInventory(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }

        return view('app_sale.product_inventory');
    }

    public function createOrder(Request $request)
    {
        return view('app_sale.create_order');
    }

    public function postCreateOrder(Request $request)
    {
        $dataForm = $request->all();
        $dataLogin = session()->get('dataLogin');
        $productVariant = [];
        foreach ($dataForm['product_variant_id'] as $key => $value) {
            $productVariant[] = [
                'id' => $value,
                'quantity' => $dataForm['quantity'][$key]
            ];
        }
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $params = [
            'distributor_id' => $dataForm['distributor_id'],
            'total_amount' => 0,
            'product_variant' => $productVariant
        ];

        $this->setOptions($option);
        $result = $this->post('api/v1/order/create', $params, $header);

        if (isset($result['status']) && $result['status'] == 200) {
            return redirect(route('app_sale.order'))->with(['message_success' => 'Tạo đơn hàng thành công']);
        } else {
            return Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
        }
    }

    public function order(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $page = $request->get('page') ?? 1;
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $params = [
            'page' => $page,
            'length' => 100,
        ];

        $result = $this->get('api/v1/order', $params, $header);
        $listOrders = [];

        if (isset($result['status']) && $result['status'] == 200) {
            $listOrders = $result['data']['results'];
        }

        return view('app_sale.list_order', compact('listOrders'));
    }

    public function storePrescription(Request $request)
    {
        $dataLogin = session()->get('dataLogin');
        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $productVariantIds = $request->get('product_variant_id');
        $arrVariantId = [];
        if (!empty($productVariantIds)) {
            foreach ($productVariantIds as $productVariantId) {
                if (!empty(json_decode($productVariantId))) {
                    foreach ((json_decode($productVariantId)) as $value) {
                        $arrVariantId[] = $value;
                    }
                }
            }
        }

        $params = [
            'examination_id' => $request->get('examination_id'),
            'animals' => $request->get('animals'),
            'weight' => $request->get('weight'),
            'quantity' => $request->get('quantity'),
            'food' => $request->get('food'),
            'symptom' => $request->get('symptom'),
            'sickness' => $request->get('sickness'),
            'prehistoric' => $request->get('prehistoric'),
            'diagnostic' => $request->get('diagnostic'),
            'product_variant_id' => $arrVariantId,
            'note' => $request->get('note'),
        ];
        if ($request->get('distributor_id')) {
            $params['distributor_id'] = $request->get('distributor_id');
        }

        $option['base_url'] = $this->baseUrl;
        $this->setOptions($option);
        $result = $this->post('api/v1/prescription/create', $params, $header);

        if (isset($result['status']) && $result['status'] == 200) {
            return redirect(route('app_sale.home'))->with(['message_success' => 'Tạo mới đơn hàng thành công']);
        }

        return redirect()->back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
    }


    public function appointment(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $dataCheckIn = session()->get('dataCheckIn');

        return view('app_sale.appointment', compact('dataCheckIn'));
    }

    // store appointment
    public function storeAppointment(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $dataCheckIn = session()->get('dataCheckIn');

        $arrayImage = [];
        if ($images = $request->get('arrImages')) {
            $arrayImage = explode(',', $images);
        }

        $option['base_url'] = $this->baseUrl;
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $comments = $request->get('comment');
        $arrImageAndComment = [];

        if (!empty($arrayImage)) {
            foreach ($arrayImage as $key => $image) {
                foreach ($comments as $k => $comment) {
                    if ($key == $k) {
                        $arrImageAndComment[] = [
                            'image' => $image,
                            'content' => $comment
                        ];
                    }
                }
            }
        }

        $params = [
            'working_plan_detail_id' => $dataCheckIn['working_plan_detail_id'],
            'images' => $arrImageAndComment
        ];

        $result = $this->post('api/v1/examination', $params, $header);

        if (isset($result['id']) && $result['id'] > 0) {
            if ($this->wantsJson()) {
                return response()->json(['data'=> $result['id'], 'status' => 200]);
            }

            return redirect(route('app_sale.home'))->with(['message_success' => 'Cập nhật thăm khám thành công']);
        } else {
            return Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
        }
    }

    public function uploadFile(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $option['base_url'] = $this->baseUrl;
        $params = [
            'name' => 'image',
            'contents' => Utils::tryFopen($request->file('image')->getRealPath(), 'r'),
            'filename' => $request->file('image')->getClientOriginalName(),
            'headers' => [
                'Content-Type' => 'multipart/form-data',
                'Authorization' => 'Bearer ' . $dataLogin['access_token']
            ]
        ];

        $this->setOptions($option);
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $dataLogin['access_token']
            ]
        ]);
        $data = $client->request('post', $this->baseUrl . '/api/v1/common/image/upload-sale', [
            'multipart' => [$params]
        ]);

        if ($data->getStatusCode() === 200) {
            $data = $data->getBody()->getContents();
        }

        return $data;
    }

    public function uploadFileSelfie(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $option['base_url'] = $this->baseUrl;
        $params = [
            'name' => 'image',
            'contents' => Utils::tryFopen($request->file('selfie')->getRealPath(), 'r'),
            'filename' => $request->file('selfie')->getClientOriginalName(),
            'headers' => [
                'Content-Type' => 'multipart/form-data',
                'Authorization' => 'Bearer ' . $dataLogin['access_token']
            ]
        ];

        $this->setOptions($option);
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $dataLogin['access_token']
            ]
        ]);
        $data = $client->request('post', $this->baseUrl . '/api/v1/common/image/upload-sale', [
            'multipart' => [$params]
        ]);

        if ($data->getStatusCode() === 200) {
            $data = $data->getBody()->getContents();
        }

        return $data;
    }

    public function prescription(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $page = $request->get('page') ?? 1;
        $length = $request->get('length') ?? 10;
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $params = [
            'page' => $page,
            'length' => $length
        ];

        $result = $this->get('api/v1/prescription/index', $params, $header);
        $listPrescriptions = [];
        if (isset($result['status']) && $result['status'] == 200) {
            $listPrescriptions = $result['data']['results'];
        }

        return view('app_sale.list_prescription', compact('listPrescriptions'));
    }

    public function storeCheckIn(Request $request)
    {
        $option['base_url'] = $this->baseUrl;
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $addressId = $request->get('idAddress');
        $arrImages = $request->get('arrImages');
        $imageSelfie = $request->get('imageSelfie');
        $type = $request->get('type');
        $phoneNumber = $request->get('phone_number');
        $nameFarm = $request->get('nameFarm');
        $address = $request->get('address');
        $latLng = $request->get('latLng');
        $arrayLatLng = [];

        if ($latLng) {
            $arrayLatLng = (array)json_decode($latLng);
        }
        $images = [];

        if ($arrImages) {
            $images = explode(',', $arrImages);
        }
        $lat = '';
        $lng = '';

        if (!empty($arrayLatLng)) {
            $lat = $arrayLatLng['lat'];
            $lng = $arrayLatLng['lng'];
        }

        $params = [
            'selfie_image' => $imageSelfie,
            'images' => $images,
            'latitude' => $lat,
            'longitude' => $lng,
            'working_plan_detail_id' => $addressId
        ];

        $header = [
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];

        $this->setOptions($option);

        $result = $this->post('api/v1/userCheckin', $params, $header);
        if (isset($result['status']) && $result['status'] == 200) {
            $arrayType = [
                'type' => $type,
                'phone_number' => $phoneNumber,
                'name_farm' => $nameFarm,
                'address' => $address
            ];
            $dataCheckIn = array_merge($result['data'], $arrayType);

            session()->put('dataCheckIn', $dataCheckIn);
            session()->save();

            return redirect()->route('app_sale.home');
        }

        return redirect()->back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
    }

    public function getDistributor(Request $request)
    {
        $dataLogin = session()->get('dataLogin');
        $page = $request->get('page') ?? 1;
        $term = $request->get('term') ?? '';
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $params = [
            'page' => $page,
            'term' => $term,
            'length' => 10
        ];
        $this->setOptions($option);
        $result = $this->get('api/v1/distributor/list', $params, $header);

        return $result['data'];
    }

    public function checkout(Request $request)
    {
        $dataLogin = session()->get('dataLogin');
        $option['base_url'] = $this->baseUrl;

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
        $dataCheckIn = session()->get('dataCheckIn');

        $params = [
            'checkin_id' => $dataCheckIn['id'],
            'latitude' => $dataCheckIn['checkin_latitude'],
            'longitude' => $dataCheckIn['checkin_longitude'],
        ];

        $header = [
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $result = $this->put('api/v1/userCheckin', $params, $header);

        if (isset($result['status']) && $result['status'] == 200) {
            session()->forget('dataCheckIn');

            return view('app_sale.home_not_checkin');
        }

        return redirect()->back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
    }

    public function createPrescription()
    {
        $dataLogin = session()->get('dataLogin');

        $dataCheckIn = session()->get('dataCheckIn');

        if (!$dataCheckIn) {
            return redirect()->back();
        }

        return view('app_sale.create_prescription', compact('dataLogin','dataCheckIn'));
    }

    public function searchProduct(Request $request)
    {
        $dataLogin = session()->get('dataLogin');
        $page = $request->get('page') ?? 1;
        $keyword = $request->get('keyword') ?? '';
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $params = [
            'page' => $page,
            'length' => 10,
            'keyword' => $keyword
        ];
        $this->setOptions($option);
        $result = $this->get('api/v1/products/search', $params, $header);

        $data['html'] = '';
        if (isset($result['status']) && $result['status'] == 200) {
            $data['status'] = 200;
            $products = $result['data']['results'];
            if (count($products) > 0) {
                foreach ($products as $product) {
                    $product_variants = $product['product_variant'] ?? [];
                    foreach ($product_variants as $product_variant) {
                        $data['html'] .= '
                            <tr data-product-variant="'. json_encode($product_variant['id']) .'" data-id="' . $product['id'] . '" data-code="' . $product['code'] . '" data-name="' . $product['name'] . ' - ' . $product_variant['name'] . '">
                                <td>' . $product['code'] . '</td>
                                <td>' . $product['name'] . ' - ' . $product_variant['name'] . '</td>
                            </tr>
                        ';
                    }
                }
            } else {
                $data['html'] = '
                    <tr>
                        <td colspan="2">Không có dữ liệu</td>
                    </tr>
                ';
            }

        } else {
            $data['status'] = 500;
            $data['html'] = '
                <tr>
                    <td colspan="2">Không có dữ liệu</td>
                </tr>
            ';
        }

        return $data;
    }

    private function wantsJson()
    {
        $acceptable = request()->getAcceptableContentTypes();
        return isset($acceptable[0]) && $acceptable[0] == 'application/json';
    }

    public function getAnimals(Request $request)
    {
        if ($request->session()->has('dataLogin')) {
            $dataLogin = $request->session()->get('dataLogin');
        } else {
            return redirect(route('app_sale.login'));
        }
        $page = $request->get('page') ?? 1;
        $term = $request->get('term') ?? '';
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $params = [
            'page' => $page,
            'term' => $term,
            'length' => 10
        ];

        $this->setOptions($option);
        $result = $this->get('api/v1/common/sale/animals', $params, $header);

        return $result['data'];
    }

    public function searchProductInventory(Request $request)
    {
        $dataLogin = session()->get('dataLogin');
        $keyword = $request->get('keyword') ?? '';
        $except = $request->get('except') ?? [];
        if (!empty($except)) {
            foreach ($except as $k => $v){
                $except[$k] = (int)$v;
            }
        }

        $distributorId = $request->get('distributor_id') ?? '';
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $params = [
            'term' => $keyword,
            'except' => $except,
            'distributor_id' => $distributorId
        ];

        $this->setOptions($option);
        $result = $this->get('api/v1/search-consignment-for-stock-adjust', $params, $header);

        $data['html'] = '';
        if (isset($result['status']) && $result['status'] == 200) {
            $data['status'] = 200;
            $products = $result['data']['results'];
            if (count($products) > 0) {
                foreach ($products as $product) {
                    $data['html'] .= '
                        <tr 
                        data-distributor="' . $product['id'] . '" 
                        data-total-quantity="' . $product['total_quantity'] . '" 
                        data-code-product="' . $product['product_code'] . '" 
                        data-code="' . $product['code'] . '" 
                        data-name="' . $product['product'] . '">
                            <td>' . $product['product_code'] . '</td>
                            <td>' . $product['product'] . '</td>
                            <td>' . $product['code'] . '</td>
                            <td>' . $product['total_quantity'] . '</td>
                        </tr>
                    ';
                }
            } else {
                $data['html'] = '
                    <tr>
                        <td colspan="2">Không có dữ liệu</td>
                    </tr>
                ';
            }

        } else {
            $data['status'] = 500;
            $data['html'] = '
                <tr>
                    <td colspan="2">Không có dữ liệu</td>
                </tr>
            ';
        }

        return $data;
    }

    public function updateProductInventory(Request $request)
    {
        $dataLogin = session()->get('dataLogin');
        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $dataLogin['access_token']
        ];
        $quantities = $request->get('quantity');
        foreach ($quantities as $k => $quantity) {
            $quantities[$k] = (int) $quantity;
        }
        $params = [
            'distributor_from' => $request->get('distributor_from') ? (int)  $request->get('distributor_from') : "",
            'quantity' => $quantities,
            'reason' => $request->get('reason'),
        ];

        $option['base_url'] = $this->baseUrl;
        $this->setOptions($option);

        $result = $this->post('api/v1/stock-adjust', $params, $header);

        if (isset($result['status']) && $result['status'] == 200) {
            return redirect(route('app_sale.home'))->with(['message_success' => 'Cập nhật kiểm kê hàng hóa thành công']);
        }

        return redirect()->back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
    }
}
