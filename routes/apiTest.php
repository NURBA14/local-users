<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\DocsController;
use App\Http\Responders\Responder;
use Illuminate\Support\Facades\Route;

Route::middleware(["jsonResponse", "access", "premition"])->group(function () {
    Route::controller(DocsController::class)->prefix("docs")->group(function () {
        Route::get("/service/list", "serviceList");
        Route::get("/service/show", "serviceShow");
    });
    Route::any("/service", [BaseController::class, "index"]);
    Route::get("/test", function (Responder $responder) {
        return $responder->success(__("Successful access"), [], [], 200); //TODO test route
    });
});