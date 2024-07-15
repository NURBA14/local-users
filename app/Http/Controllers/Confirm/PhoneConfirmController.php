<?php

namespace App\Http\Controllers\Confirm;

use App\Http\Controllers\Controller;
use App\Services\Confirm\Phone\PhoneConfirmStep1Service;
use App\Services\Confirm\Phone\PhoneConfirmStep2Service;
use Illuminate\Http\Request;

class PhoneConfirmController extends Controller
{
    public function step1(PhoneConfirmStep1Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function step2(PhoneConfirmStep2Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
