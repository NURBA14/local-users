<?php

namespace App\Http\Controllers\Confirm;

use App\Http\Controllers\Controller;
use App\Services\Confirm\Email\EmailConfirmStep1Service;
use App\Services\Confirm\Email\EmailConfirmStep2Service;
use Illuminate\Http\Request;

class EmailConfirmController extends Controller
{
    public function step1(EmailConfirmStep1Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function step2(EmailConfirmStep2Service $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
