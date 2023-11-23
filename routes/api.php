<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(UserController::class)->group(function () {
    Route::post("/sign-in", 'signIn');
    Route::post("/forgot-password", 'forgotPassword');
    Route::post("/login", 'login');
    Route::post("/otp-verification", 'otpVerification')->middleware("auth:api");
});

Route::middleware(["auth:api","verified_api"])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post("/edit-profile", 'editProfile');
        Route::post("/edit-password", 'editPassword');
    });
});
