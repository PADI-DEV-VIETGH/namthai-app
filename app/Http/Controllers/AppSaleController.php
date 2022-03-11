<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
