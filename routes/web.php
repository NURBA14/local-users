<?php

use App\Company\Http\ActionsController;
use App\Http\Responders\Responder;
use App\Services\Docs\ServiceListService;
use App\Services\Statistic\CommonStatisticService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/wasd", function () {
    return view("mail.confirm.emailconfirm", ['email' => "muradnurbolat85@gmail.com", 'smscode' => 1244]);
});

Route::get('/', function () {
    return view('index');
})->name("home");

Route::get('/docs', function () {
    $service = new ServiceListService();
    $result = $service->load(request()->all())->handle();
    $data = $result->getData()->data;
    return view("pages.docs", ['data' => $data]);
})->name("docs.index");

Route::get('/statistic', function () {
    return view('pages.statistic');
})->name("statistic");