<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Services\Register\Phone\PhoneRegisterStep1Service;
use App\Services\Register\Phone\PhoneRegisterStep2Service;
use App\Services\Register\Phone\PhoneRegisterStep3Service;
use Illuminate\Http\Request;

class PhoneRegisterController extends Controller
{
    public function step1(PhoneRegisterStep1Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function step2(PhoneRegisterStep2Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function step3(PhoneRegisterStep3Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
