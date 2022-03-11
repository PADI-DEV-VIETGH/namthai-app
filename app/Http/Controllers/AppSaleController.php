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
        $dataLogin = session()->get('dataLogin');

        if (!$dataLogin) {
            return redirect(route('app_sale.login'));
        }
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
        $status = $request->get('status');
        $comments = $request->get('comment');
        // chờ api anh Nghĩa
        dd($arrayImage, $status, $comments);
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
            session()->put('dataCheckIn', $result['data']);
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

}
