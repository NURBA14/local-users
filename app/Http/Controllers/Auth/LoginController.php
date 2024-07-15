<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginConfirmedService;
use App\Services\Auth\LoginStandartService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function confirmed(LoginConfirmedService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }

    public function standart(LoginStandartService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
