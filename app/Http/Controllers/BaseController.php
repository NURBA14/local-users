<?php

namespace App\Http\Controllers;

use App\Base\ServiceBase\ServiceFactory;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index(Request $request)
    {
        return ServiceFactory::handle($request);
    }
}
