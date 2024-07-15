<?php

namespace App\Http\Controllers;

use App\Services\Docs\ServiceListService;
use App\Services\Docs\ServiceShowService;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function serviceList(ServiceListService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function serviceShow(ServiceShowService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
