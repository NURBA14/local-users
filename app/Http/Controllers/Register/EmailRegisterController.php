<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Services\Register\Email\EmailRegisterStep1Service;
use App\Services\Register\Email\EmailRegisterStep2Service;
use App\Services\Register\Email\EmailRegisterStep3Service;
use Illuminate\Http\Request;

class EmailRegisterController extends Controller
{
    public function step1(EmailRegisterStep1Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function step2(EmailRegisterStep2Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function step3(EmailRegisterStep3Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
