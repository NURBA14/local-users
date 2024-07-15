<?php

namespace App\Http\Controllers\ResetPassword;

use App\Http\Controllers\Controller;
use App\Services\ResetPassword\Phone\PhoneResetPasswordStep1Service;
use App\Services\ResetPassword\Phone\PhoneResetPasswordStep2Service;
use Illuminate\Http\Request;

class PhoneResetPasswordController extends Controller
{
    public function step1(PhoneResetPasswordStep1Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function step2(PhoneResetPasswordStep2Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
