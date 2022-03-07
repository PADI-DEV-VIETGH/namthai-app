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
        $header = [
            'Content-Type' => 'application/json'
        ];

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
                'onesignal_player_id' => 'aaaaaaaaaaa',
            ]
        ];

        $this->setOptions($option);
        $result = $this->post('api/v1/farm/auth/login', $header, $params);

        dd($result);
    }
}
