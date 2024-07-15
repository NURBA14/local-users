<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserCreateService;
use App\Services\Admin\UserShowByIinService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addUser(UserCreateService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }

    public function findByIin(UserShowByIinService $service, Request $request)
    {
        return $service->load($request->all())->handle();
    }

}
