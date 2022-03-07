<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppFarmController extends Controller
{
    public function login()
    {
        return view('app_farm.login');
    }
}
