<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Confirm\EcpConfirmController;
use App\Http\Controllers\Confirm\EmailConfirmController;
use App\Http\Controllers\Confirm\PhoneConfirmController;
use App\Http\Controllers\DefaultList\StatusListController;
use App\Http\Controllers\DefaultList\TablesDefaultListController;
use App\Http\Controllers\Docs\DocsController;
use App\Http\Controllers\Gender\GenderController;
use App\Http\Controllers\Nationality\NationalityController;
use App\Http\Controllers\Register\EcpRegisterController;
use App\Http\Controllers\Register\EmailRegisterController;
use App\Http\Controllers\Register\PhoneRegisterController;
use App\Http\Controllers\ResetPassword\EmailResetPasswordController;
use App\Http\Controllers\ResetPassword\PhoneResetPasswordController;
use App\Http\Controllers\Statistic\StatisticController;
use App\Http\Controllers\Users\ListController;
use Illuminate\Support\Facades\Route;

Route::middleware(["jsonResponse", "access", "premition"])->group(function () {
    Route::controller(UserController::class)->prefix("admin")->group(function () {
        Route::post("/add/user", "addUser");
        Route::get("/find/by/iin", "findByIin");
    });

    Route::controller(LoginController::class)->prefix("login")->group(function () {
        Route::post("/standart", "standart");
        Route::post("/confirmed", "confirmed");
    });

    Route::prefix("register")->group(function () {
        Route::controller(EmailRegisterController::class)->prefix("email")->group(function () {
            Route::post("/step1", "step1");
            Route::post("/step2", "step2");
            Route::post("/step3", "step3");
        });
        Route::controller(PhoneRegisterController::class)->prefix("phone")->group(function () {
            Route::post("/step1", "step1");
            Route::post("/step2", "step2");
            Route::post("/step3", "step3");
        });
        Route::post("/ecp", [EcpRegisterController::class, "ecpRegister"]);
    });
    Route::prefix("confirm")->group(function () {
        Route::controller(EmailConfirmController::class)->prefix("email")->group(function () {
            Route::post("/step1", "step1");
            Route::post("/step2", "step2");
        });
        Route::controller(PhoneConfirmController::class)->prefix("phone")->group(function () {
            Route::post("/step1", "step1");
            Route::post("/step2", "step2");
        });
        Route::post("/ecp", [EcpConfirmController::class, "confirmEcp"]);
    });
    Route::prefix("reset/password")->group(function () {
        Route::controller(EmailResetPasswordController::class)->prefix("email")->group(function () {
            Route::post("/step1", "step1");
            Route::post("/step2", "step2");
        });
        Route::controller(PhoneResetPasswordController::class)->prefix("phone")->group(function () {
            Route::post("/step1", "step1");
            Route::post("/step2", "step2");
        });
    });
    Route::prefix("list")->group(function () {
        Route::get("/genders", [GenderController::class, "list"]);
        Route::get("/nationalities", [NationalityController::class, "list"]);
        Route::get("/accounts", [ListController::class, "accounts"]);
        Route::get("/profiles", [ListController::class, "profiles"]);
        Route::get("/users", [ListController::class, "users"]);
        Route::prefix("default")->group(function () {
            Route::controller(StatusListController::class)->group(function () {
                Route::get("/iin/status", "iin_status");
                Route::get("/account/status", "account_status");
                Route::get("/profile/status", "profile_status");
                Route::get("/confirm/status", "confirm_status");
            });
            Route::controller(TablesDefaultListController::class)->group(function () {
                Route::get("/nationalities", "nationalities");
                Route::get("/genders", "genders");
            });
        });
    });

    Route::controller(DocsController::class)->prefix("docs")->group(function () {
        Route::get("/service/list", "serviceList");
        Route::get("/service/show", "serviceShow");
    });

    Route::controller(StatisticController::class)->prefix("statistic")->group(function () {
        Route::get("/common", "common");
    });
});