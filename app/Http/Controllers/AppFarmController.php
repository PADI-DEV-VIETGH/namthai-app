<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;

class AppFarmController extends Controller
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('BASE_URL');
    }

    public function home(Request $request)
    {
        if ($request->session()->has('farm')) {
            $farm = $request->session()->get('farm');
        } else {
            return redirect(route('app_farm.login'));
        }

        return view('app_farm.home');
    }

    public function createAppointment(Request $request)
    {
        if ($request->session()->has('farm')) {
            $farm = $request->session()->get('farm');
        } else {
            return redirect(route('app_farm.login'));
        }

        return view('app_farm.create_appointment', compact('farm'));
    }

    public function postCreateAppointment(Request $request)
    {
        if ($request->session()->has('farm')) {
            $farm = $request->session()->get('farm');
        } else {
            return redirect(route('app_farm.login'));
        }

        $dataForm = $request->all();

        $arrayImage = [];
        if ($images = $request->get('arrImages')) {
            $arrayImage = explode(',', $images);
        }

        $images = [];
        foreach ($arrayImage as $key => $value) {
            $images[] = [
                'url' => $value,
                'comment' => $dataForm['comment'][$key]
            ];
        }

        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $farm['access_token']
        ];
        $params = [
            'animals' => $dataForm['animals'] ?? [],
            'symptom' => $dataForm['symptom'] ?? '',
            'images' => $images,
            'note' => $dataForm['note'] ?? '',
            'expect_appointment' => $dataForm['expect_appointment'] ?? ''
        ];

        $this->setOptions($option);
        $result = $this->post('api/v1/appointment/create', $params, $header);

        if (isset($result['status']) && $result['status'] == 200) {
            return redirect(route('app_farm.list_appointment'))->with(['message_success' => 'Tạo yêu cầu thăm khám thành công']);
        } else {
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
        }
    }

    public function listAppointment(Request $request)
    {
        if ($request->session()->has('farm')) {
            $farm = $request->session()->get('farm');
        } else {
            return redirect(route('app_farm.login'));
        }

        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $farm['access_token']
        ];
        $params = [
            'page' => 1,
            'length' => 100
        ];

        $this->setOptions($option);
        $result = $this->get('api/v1/appointment/list', $params, $header);

        if (isset($result['status']) && $result['status'] == 200) {
            $appointments = $result['data']['results'];
            $employee = $result['data']['user'];

            return view('app_farm.list_appointment', compact('appointments', 'employee'));
        } else {
            return  Redirect::route('app_farm.login')->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
        }
    }

    public function showAppointment(Request $request, $id)
    {
        if ($request->session()->has('farm')) {
            $farm = $request->session()->get('farm');
        } else {
            return redirect(route('app_farm.login'));
        }

        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $farm['access_token']
        ];
        $params = [
            'id' => $id
        ];

        $this->setOptions($option);
        $result = $this->get('api/v1/appointment/show', $params, $header);

        if (isset($result['status']) && $result['status'] == 200) {
            $appointment = $result['data'];
            $employee = $result['data']['sale'];

            return view('app_farm.show_appointment', compact('farm', 'appointment', 'employee'));
        } else {
            return  Redirect::route('app_farm.login')->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
        }
    }

    public function login()
    {
        return view('app_farm.login');
    }

    public function postLogin(Request $request)
    {
        $dataForm = $request->all();

        $option['base_url'] = $this->baseUrl;
        $params = [
            'credential' => [
                'phone_number' => $dataForm['phone_number'],
                'password' => $dataForm['password'],
            ],
            'device' => [
                'uid' => 'employee_18',
                'model' => 'HTC One (M8)',
                'os' => 'android',
                'os_version' => 'android 8.0',
                'app_version' => '1.0',
                'onesignal_player_id' => 'aaaaaaaaa',
            ]
        ];

        $this->setOptions($option);
        $result = $this->post('api/v1/farm/auth/login', $params);

        if (isset($result['status']) && $result['status'] == 200) {
            $request->session()->put('farm', $result['data']);

            return redirect(route('app_farm.home'));
        } else {
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['data']['message']]);
        }
    }

    public function register()
    {
        return view('app_farm.register');
    }

    public function postRegister(Request $request)
    {
        $dataForm = $request->all();
        if ($dataForm['password'] != $dataForm['comfirm_password']) {
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => 'Mật khẩu không trùng khớp']);
        }
        $option['base_url'] = $this->baseUrl;
        $params = [
            'full_name' => $dataForm['full_name'],
            'dob' => $dataForm['dob'],
            'gender' => $dataForm['gender'] ?? 1,
            'phone_number' => $dataForm['phone_number'],
            'password' => $dataForm['password'],
            'ward_id' => $dataForm['ward_id'] ?? '',
            'address_detail' => $dataForm['address_detail'] ?? '',
        ];
        $this->setOptions($option);
        $result = $this->post('api/v1/farm/auth/register', $params);

        if (isset($result['status_code']) && $result['status_code'] != 200) {
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message']]);
        }
        if (isset($result['status']) && $result['status'] == 200) {
            $request->session()->put('phone_number', $result['data']['phone_number']);

            return redirect(route('app_farm.otp'))->with(['message_success' => 'Đăng ký thành công, vui lòng nhập mã OTP được gửi về zalo để xác thực']);
        } else {
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['error']['message'] ?? $result['error']['message']]);
        }
    }

    public function otp()
    {
        return view('app_farm.otp');
    }

    public function postOtp(Request $request)
    {
        $phoneNumber = $request->session()->get('phone_number');
        $dataForm = $request->all();
        $option['base_url'] = $this->baseUrl;
        $params = [
            'phone_number' => $phoneNumber,
            'otp_code' => $dataForm['otp_code']
        ];
        $this->setOptions($option);
        $result = $this->post('api/v1/farm/auth/verify-register', $params);

        if (isset($result['status']) && $result['status'] == 200) {
            $request->session()->forget('phone_number');
            return redirect(route('app_farm.login'))->with(['message_success' => 'Xác thực tài khoản thành công, vui lòng đăng nhập']);
        } else {
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['data']['message'] ?? $result['error']['message']]);
        }
    }

    public function resendOtp(Request $request)
    {
        $phoneNumber = $request->session()->get('phone_number');
        $option['base_url'] = $this->baseUrl;
        $params = [
            'phone_number' => $phoneNumber
        ];
        $this->setOptions($option);
        $result = $this->post('api/v1/farm/auth/resend-otp', $params);

        if (isset($result['status']) && $result['status'] == 200) {
            return redirect(route('app_farm.otp'))->with(['message_success' => 'Đã gửi lại mã OTP vào zalo']);
        } else {
            return  Redirect::back()->withInput($request->input())->withErrors(['message_error' => $result['data']['message'] ?? $result['error']['message']]);
        }
    }

    public function getProvince(Request $request)
    {

        $page = $request->get('page') ?? 1;
        $term = $request->get('term') ?? '';
        $option['base_url'] = $this->baseUrl;
        $params = [
            'page' => $page,
            'term' => $term,
            'length' => 10
        ];
        $this->setOptions($option);
        $result = $this->get('api/v1/common/area/provinces', $params);

        return $result['data'];
    }

    public function getDistrict(Request $request)
    {
        $page = $request->get('page') ?? 1;
        $term = $request->get('term') ?? '';
        $province_id = $request->get('province_id') ?? '';
        $option['base_url'] = $this->baseUrl;
        $params = [
            'page' => $page,
            'term' => $term,
            'province_id' => $province_id,
            'length' => 10
        ];
        $this->setOptions($option);
        $result = $this->get('api/v1/common/area/districts', $params);

        return $result['data'];
    }

    public function getWard(Request $request)
    {
        $page = $request->get('page') ?? 1;
        $term = $request->get('term') ?? '';
        $district_id = $request->get('district_id') ?? '';
        $option['base_url'] = $this->baseUrl;
        $params = [
            'page' => $page,
            'term' => $term,
            'district_id' => $district_id,
            'length' => 10
        ];
        $this->setOptions($option);
        $result = $this->get('api/v1/common/area/wards', $params);

        return $result['data'];
    }

    public function getAnimals(Request $request)
    {
        if ($request->session()->has('farm')) {
            $farm = $request->session()->get('farm');
        } else {
            return redirect(route('app_farm.login'));
        }
        $page = $request->get('page') ?? 1;
        $term = $request->get('term') ?? '';
        $option['base_url'] = $this->baseUrl;
        $header = [
            'Authorization' => 'Bearer ' . $farm['access_token']
        ];
        $params = [
            'page' => $page,
            'term' => $term,
            'length' => 10
        ];

        $this->setOptions($option);
        $result = $this->get('api/v1/common/animals', $params, $header);

        return $result['data'];
    }

    public function uploadFile(Request $request)
    {
        $option['base_url'] = $this->baseUrl;
        $dataLogin = session()->get('farm');
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

        $data =  $client->request('post', $this->baseUrl . '/api/v1/common/image/upload', [
            'multipart' => [$params]
        ]);

        if ($data->getStatusCode() === 200) {
            $data = $data->getBody()->getContents();
        }

        return $data;
    }
}
