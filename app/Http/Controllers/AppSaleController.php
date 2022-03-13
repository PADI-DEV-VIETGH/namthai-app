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
        $dataLogin = $this->post('api/v1/sale/auth/login',$params);

        if (isset($dataLogin['status']) && $dataLogin['status'] == 200) {
            session()->put('dataLogin', $dataLogin['data']);
            session()->save();

            return redirect()->route('app_sale.home');
        }

        return  redirect()->back()->withInput($request->input())->withErrors(['message_error' => $dataLogin['error']['message'] ?? $dataLogin['data']['message']]);

    }

    public function home(Request $request)
    {
        $dataLogin = session()->get('dataLogin');
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
        $term = $request->get('term') ?? '';
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);

//        $params = [
//            'page' => $page,
//            'term' => $term,
//            'length' => 10
//        ];

        $listWorkingPlan = $this->get('api/v1/workingPlans', [], $header);

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
        foreach($dataForm['product_variant_id'] as $key => $value){
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
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
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
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $params = [
            'page' => $page
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
        if ($images = $request->get('arrImages')) {
            $arrayImage = explode(',', $images);
        }

        $option['base_url'] = $this->baseUrl;
        $this->setOptions($option);

        // chờ api anh Nghĩa

        return view('app_sale.create_prescription');
    }


    // store appointment
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
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $comments = $request->get('comment');
        $arrImageAndComment = [];

        if(!empty($arrayImage)) {
            foreach($arrayImage as $key => $image) {
                foreach($comments as $k => $comment) {
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
        dd($result);
        if (isset($result['status']) && $result['status'] == 200) {
            return redirect(route('app_sale.home'))->with(['message_success' => 'Cập nhật thăm khám thành công']);
        } else {
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
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
        $data =  $client->request('post', $this->baseUrl . '/api/v1/common/image/upload-sale', [
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
        $data =  $client->request('post', $this->baseUrl.'/api/v1/common/image/upload-sale', [
            'multipart' => [$params]
        ]);

        if ($data->getStatusCode() === 200) {
            $data = $data->getBody()->getContents();
        }

        return $data;
    }

    public function prescription (Request $request)
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
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
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
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
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

    public function getDistributor(Request $request){
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
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
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
        $dataCheckIn = session()->get('dataCheckIn');

        if (!$dataCheckIn) {
            return redirect()->back();
        }

        return view('app_sale.create_prescription');
    }

    public function searchProduct(Request $request){
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
        if(isset($result['status']) && $result['status'] == 200){
            $data['status'] = 200;
            $products = $result['data']['results'];
            if(count($products) > 0){
                foreach($products as $product){
                    $product_variants = $product['product_variant']??[];
                    foreach($product_variants as $product_variant){
                        $data['html'] .= '
                            <tr data-id="'.$product['id'].'" data-code="'.$product['code'].'" data-name="'.$product['name']. ' - '.$product_variant['name'].'">
                                <td>'.$product['code'].'</td>
                                <td>'.$product['name']. ' - '.$product_variant['name'].'</td>
                            </tr>
                        ';
                    }
                }
            }else{
                $data['html'] = '
                    <tr>
                        <td colspan="2">Không có dữ liệu</td>
                    </tr>
                ';
            }
            
        }else{
            $data['status'] = 500;
            $data['html'] = '
                <tr>
                    <td colspan="2">Không có dữ liệu</td>
                </tr>
            ';
        }

        return $data;
    }
}
