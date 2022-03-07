<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppFarmController extends Controller
{
    private $baseUrl = 'http://namthai.local';

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

        dd($result);
    }

    public function register()
    {
        return view('app_farm.register');
    }

    public function postRegister(Request $request)
    {
        $option['base_url'] = $this->baseUrl;
        $params = [
            'full_name' => 'employee_18',
            'dob' => 'HTC One (M8)',
            'gender' => 'android',
            'phone_number' => 'android 8.0',
            'password' => 'android 8.0',
            'ward_id' => '1.0',
            'address_detail' => 'aaaaaaaaa',
        ];

        $this->setOptions($option);
        $result = $this->post('api/v1/farm/auth/register', $params);

        dd($result);
    }

    public function getProvince(Request $request){

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

    public function getDistrict(Request $request){
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

    public function getWard(Request $request){
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
