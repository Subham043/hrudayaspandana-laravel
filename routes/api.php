<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RefreshController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResendOTPController;
use App\Http\Controllers\Auth\VerifyUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Contact\ContactPaginateController;
use App\Http\Controllers\Contact\ContactCreateController;
use App\Http\Controllers\Contact\ContactEditController;
use App\Http\Controllers\Contact\ContactDeleteController;
use App\Http\Controllers\Contact\ContactDisplayController;
use App\Http\Controllers\Volunteer\VolunteerPaginateController;
use App\Http\Controllers\Volunteer\VolunteerCreateController;
use App\Http\Controllers\Volunteer\VolunteerEditController;
use App\Http\Controllers\Volunteer\VolunteerDeleteController;
use App\Http\Controllers\Volunteer\VolunteerDisplayController;
use App\Http\Controllers\Subscription\SubscriptionPaginateController;
use App\Http\Controllers\Subscription\SubscriptionCreateController;
use App\Http\Controllers\Subscription\SubscriptionEditController;
use App\Http\Controllers\Subscription\SubscriptionDeleteController;
use App\Http\Controllers\Subscription\SubscriptionDisplayController;
use App\Http\Controllers\Crossword\CrosswordPaginateController;
use App\Http\Controllers\Crossword\CrosswordCreateController;
use App\Http\Controllers\Crossword\CrosswordEditController;
use App\Http\Controllers\Crossword\CrosswordDeleteController;
use App\Http\Controllers\Crossword\CrosswordDisplayController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['cors', 'json.response']], function () {

Route::prefix('/auth')->group(function () {
    Route::group(['middleware' => 'throttle:3,1'], function () {
        Route::post('/login', [LoginController::class, 'login', 'as' => 'login']);
    });
    Route::post('/register', [RegisterController::class, 'register', 'as' => 'register']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgot_password', 'as' => 'forgot_password']);
    Route::get('/refresh', [RefreshController::class, 'refresh', 'as' => 'refresh']);
    Route::get('/profile', [ProfileController::class, 'profile', 'as' => 'profile']);
    Route::get('/logout', [LogoutController::class, 'logout', 'as' => 'logout']);
    Route::get('/resend-otp/{user_id}', [ResendOTPController::class, 'send_otp', 'as' => 'send_otp']);
    Route::post('/verify-user/{user_id}', [VerifyUserController::class, 'verify_user', 'as' => 'verify_user']);
    Route::post('/reset-password/{user_id}', [ResetPasswordController::class, 'reset_password', 'as' => 'reset_password']);
});

Route::prefix('/contact')->group(function () {
    Route::group(['middleware' => 'throttle:3,1'], function () {
        Route::post('/create', [ContactCreateController::class, 'contact_create', 'as' => 'contact_create']);
    });
    Route::put('/edit/{id}', [ContactEditController::class, 'contact_edit', 'as' => 'contact_edit']);
    Route::get('/display/{id}', [ContactDisplayController::class, 'contact_display', 'as' => 'contact_display']);
    Route::delete('/delete/{id}', [ContactDeleteController::class, 'contact_delete', 'as' => 'contact_delete']);
    Route::get('/paginate', [ContactPaginateController::class, 'contact_paginate', 'as' => 'contact_paginate']);
});

Route::prefix('/volunteer')->group(function () {
    Route::group(['middleware' => 'throttle:3,1'], function () {
        Route::post('/create', [VolunteerCreateController::class, 'volunteer_create', 'as' => 'volunteer_create']);
    });
    Route::put('/edit/{id}', [VolunteerEditController::class, 'volunteer_edit', 'as' => 'volunteer_edit']);
    Route::get('/display/{id}', [VolunteerDisplayController::class, 'volunteer_display', 'as' => 'volunteer_display']);
    Route::delete('/delete/{id}', [VolunteerDeleteController::class, 'volunteer_delete', 'as' => 'volunteer_delete']);
    Route::get('/paginate', [VolunteerPaginateController::class, 'volunteer_paginate', 'as' => 'volunteer_paginate']);
});

Route::prefix('/subscription')->group(function () {
    Route::group(['middleware' => 'throttle:3,1'], function () {
        Route::post('/create', [SubscriptionCreateController::class, 'subscription_create', 'as' => 'subscription_create']);
    });
    Route::put('/edit/{id}', [SubscriptionEditController::class, 'subscription_edit', 'as' => 'subscription_edit']);
    Route::get('/display/{id}', [SubscriptionDisplayController::class, 'subscription_display', 'as' => 'subscription_display']);
    Route::delete('/delete/{id}', [SubscriptionDeleteController::class, 'subscription_delete', 'as' => 'subscription_delete']);
    Route::get('/paginate', [SubscriptionPaginateController::class, 'subscription_paginate', 'as' => 'subscription_paginate']);
});

Route::prefix('/crossword')->group(function () {
    Route::post('/create', [CrosswordCreateController::class, 'crossword_create', 'as' => 'crossword_create']);
    Route::post('/edit/{id}', [CrosswordEditController::class, 'crossword_edit', 'as' => 'crossword_edit']);
    Route::get('/display/{id}', [CrosswordDisplayController::class, 'crossword_display', 'as' => 'crossword_display']);
    Route::delete('/delete/{id}', [CrosswordDeleteController::class, 'crossword_delete', 'as' => 'crossword_delete']);
    Route::get('/paginate', [CrosswordPaginateController::class, 'crossword_paginate', 'as' => 'crossword_paginate']);
});


});