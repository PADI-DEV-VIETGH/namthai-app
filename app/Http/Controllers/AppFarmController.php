<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppFarmController extends Controller
{
    private $baseUrl = 'http://namthai.local';

    public function home(Request $request)
    {
        if (!$request->session()->has('access_token')) {
            return redirect(route('app_farm.login'));
        }
        return view('app_farm.home');
    }

    public function createAppointment(Request $request)
    {
        if (!$request->session()->has('access_token')) {
            return redirect(route('app_farm.login'));
        }
        return view('app_farm.create_appointment');
    }

    public function postCreateAppointment(Request $request)
    {
        
    }

    public function listAppointment(Request $request){
        if (!$request->session()->has('access_token')) {
            return redirect(route('app_farm.login'));
        }
        return view('app_farm.list_appointment');
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
            $request->session()->put('access_token', $result['data']['access_token']);
            $request->session()->put('farm_id', $result['data']['id']);
            $request->session()->put('farm_name', $result['data']['id']);
            $request->session()->put('farm_phone', $result['data']['id']);

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
}
