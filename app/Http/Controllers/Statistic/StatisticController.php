<?php

namespace App\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use App\Services\Statistic\CommonStatisticService;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function common(CommonStatisticService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
