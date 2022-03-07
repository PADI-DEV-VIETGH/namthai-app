<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppSaleController extends Controller
{
    public function login()
    {
        return view('app_sale.login');
    }
}
