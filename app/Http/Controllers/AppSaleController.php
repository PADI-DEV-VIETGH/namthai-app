<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppSaleController extends Controller
{
    public function login()
    {
        return view('app_sale.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only(['phone_number', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('app_sale.home_not_checkin');
        }

        return view('app_sale.home_not_checkin');
    }
}
