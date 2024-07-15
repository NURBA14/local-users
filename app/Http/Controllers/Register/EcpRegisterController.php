<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Services\Register\EcpRegisterService;
use Illuminate\Http\Request;

class EcpRegisterController extends Controller
{
    public function ecpRegister(EcpRegisterService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
