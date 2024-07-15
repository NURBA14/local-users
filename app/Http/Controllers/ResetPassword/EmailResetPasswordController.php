<?php

namespace App\Http\Controllers\ResetPassword;

use App\Http\Controllers\Controller;
use App\Services\ResetPassword\Email\EmailResetPasswordStep1Service;
use App\Services\ResetPassword\Email\EmailResetPasswordStep2Service;
use Illuminate\Http\Request;

class EmailResetPasswordController extends Controller
{
    public function step1(EmailResetPasswordStep1Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function step2(EmailResetPasswordStep2Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
