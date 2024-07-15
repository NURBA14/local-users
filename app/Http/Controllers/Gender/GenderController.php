<?php

namespace App\Http\Controllers\Gender;

use App\Http\Controllers\Controller;
use App\Services\Gender\GendersListService;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function list(GendersListService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
