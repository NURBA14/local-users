<?php

namespace App\Http\Controllers\DefaultList;

use App\Http\Controllers\Controller;
use App\Services\DefaultList\GendersDefaultListService;
use App\Services\DefaultList\NationalitiesDefaultListService;
use Illuminate\Http\Request;

class TablesDefaultListController extends Controller
{
    public function genders(GendersDefaultListService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function nationalities(NationalitiesDefaultListService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
