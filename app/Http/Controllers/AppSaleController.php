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

        if ($dataLogin && $dataLogin['data']) {
            session()->put('dataLogin', $dataLogin['data']);
            session()->save();
        }

        return redirect()->route('app_sale.home');
    }

    public function home(Request $request)
    {
        $dataLogin = session()->get('dataLogin');

        return view('app_sale.home_not_checkin', compact('dataLogin'));
    }

    public function listWorkingPlan()
    {
        $option['base_url'] = $this->baseUrl;
        $dataLogin = session()->get('dataLogin');

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $listWorkingPlan = $this->get('api/v1/workingPlans', $header);

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
        return view('app_sale.list_order');
    }

    public function storePrescription(Request $request)
    {
        if ($images = $request->get('arrImages')) {
            $arrayImage = explode(',', $images);
        }

        $option['base_url'] = $this->baseUrl;
        $dataLogin = session()->get('dataLogin');
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $status = $request->get('status');
        $comments = $request->get('comment');
        // chờ api anh Nghĩa

        return view('app_sale.create_prescription');
    }


    // store appointment
    public function appointment(Request $request)
    {
        return view('app_sale.appointment');
    }

    // store appointment
    public function storeAppointment(Request $request)
    {
        $arrayImage = [];
        if ($images = $request->get('arrImages')) {
            $arrayImage = explode(',', $images);
        }

        $option['base_url'] = $this->baseUrl;
        $dataLogin = session()->get('dataLogin');
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' =>  'Bearer ' . $dataLogin['access_token']
        ];
        $this->setOptions($option);
        $status = $request->get('status');
        $comments = $request->get('comment');
        // chờ api anh Nghĩa
        dd($arrayImage, $status, $comments);
    }

    public function uploadFile(Request $request)
    {
        $option['base_url'] = $this->baseUrl;
        $dataLogin = session()->get('dataLogin');
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

    public function prescription()
    {
        return view('app_sale.product_inventory');
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
