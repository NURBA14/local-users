<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\AccountListService;
use App\Services\Users\ProfileListService;
use App\Services\Users\UsersListService;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function accounts(AccountListService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }

    public function profiles(ProfileListService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }

    public function users(UsersListService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }
}
