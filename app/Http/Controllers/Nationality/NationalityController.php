<?php

namespace App\Http\Controllers\Nationality;

use App\Http\Controllers\Controller;
use App\Services\Nationality\NationalityListService;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function list(NationalityListService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
