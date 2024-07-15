<?php

namespace App\Http\Controllers\DefaultList;

use App\Http\Controllers\Controller;
use App\Services\DefaultList\AccountStatusService;
use App\Services\DefaultList\ConfirmStatusService;
use App\Services\DefaultList\IinStatusService;
use App\Services\DefaultList\ProfileStatusService;
use Illuminate\Http\Request;

class StatusListController extends Controller
{
    public function iin_status(IinStatusService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function account_status(AccountStatusService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function profile_status(ProfileStatusService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
    public function confirm_status(ConfirmStatusService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
