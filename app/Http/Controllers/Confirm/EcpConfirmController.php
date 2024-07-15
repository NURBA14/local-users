<?php

namespace App\Http\Controllers\Confirm;

use App\Http\Controllers\Controller;
use App\Services\Confirm\ConfirmEcpService;
use Illuminate\Http\Request;

class EcpConfirmController extends Controller
{
    public function confirmEcp(ConfirmEcpService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
