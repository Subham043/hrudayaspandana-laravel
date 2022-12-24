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
use App\Http\Controllers\Email\EmailPaginateController;
use App\Http\Controllers\Email\EmailCreateController;
use App\Http\Controllers\Email\EmailEditController;
use App\Http\Controllers\Email\EmailDeleteController;
use App\Http\Controllers\Email\EmailDisplayController;
use App\Http\Controllers\Literature\LiteraturePaginateController;
use App\Http\Controllers\Literature\LiteratureCreateController;
use App\Http\Controllers\Literature\LiteratureEditController;
use App\Http\Controllers\Literature\LiteratureDeleteController;
use App\Http\Controllers\Literature\LiteratureDisplayController;
use App\Http\Controllers\EHundi\EHundiPaginateController;
use App\Http\Controllers\EHundi\EHundiCreateController;
use App\Http\Controllers\EHundi\EHundiEditController;
use App\Http\Controllers\EHundi\EHundiDeleteController;
use App\Http\Controllers\EHundi\EHundiDisplayController;
use App\Http\Controllers\Testimonial\TestimonialPaginateController;
use App\Http\Controllers\Testimonial\TestimonialCreateController;
use App\Http\Controllers\Testimonial\TestimonialEditController;
use App\Http\Controllers\Testimonial\TestimonialDeleteController;
use App\Http\Controllers\Testimonial\TestimonialDisplayController;
use App\Http\Controllers\Media\MediaPaginateController;
use App\Http\Controllers\Media\MediaCreateController;
use App\Http\Controllers\Media\MediaEditController;
use App\Http\Controllers\Media\MediaDeleteController;
use App\Http\Controllers\Media\MediaDisplayController;
use App\Http\Controllers\Banner\BannerPaginateController;
use App\Http\Controllers\Banner\BannerCreateController;
use App\Http\Controllers\Banner\BannerEditController;
use App\Http\Controllers\Banner\BannerDeleteController;
use App\Http\Controllers\Banner\BannerDisplayController;
use App\Http\Controllers\User\UserPaginateController;
use App\Http\Controllers\User\UserPasswordController;
use App\Http\Controllers\User\UserStatusController;
use App\Http\Controllers\User\UserDeleteController;
use App\Http\Controllers\User\UserDisplayController;
use App\Http\Controllers\GalleryImage\GalleryImagePaginateController;
use App\Http\Controllers\GalleryImage\GalleryImageCreateController;
use App\Http\Controllers\GalleryImage\GalleryImageEditController;
use App\Http\Controllers\GalleryImage\GalleryImageDeleteController;
use App\Http\Controllers\GalleryImage\GalleryImageDisplayController;
use App\Http\Controllers\GalleryAudio\GalleryAudioPaginateController;
use App\Http\Controllers\GalleryAudio\GalleryAudioCreateController;
use App\Http\Controllers\GalleryAudio\GalleryAudioEditController;
use App\Http\Controllers\GalleryAudio\GalleryAudioDeleteController;
use App\Http\Controllers\GalleryAudio\GalleryAudioDisplayController;
use App\Http\Controllers\GalleryVideo\GalleryVideoPaginateController;
use App\Http\Controllers\GalleryVideo\GalleryVideoCreateController;
use App\Http\Controllers\GalleryVideo\GalleryVideoEditController;
use App\Http\Controllers\GalleryVideo\GalleryVideoDeleteController;
use App\Http\Controllers\GalleryVideo\GalleryVideoDisplayController;

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

Route::prefix('/email')->group(function () {
    Route::post('/create', [EmailCreateController::class, 'email_create', 'as' => 'email_create']);
    Route::post('/edit/{id}', [EmailEditController::class, 'email_edit', 'as' => 'email_edit']);
    Route::get('/display/{id}', [EmailDisplayController::class, 'email_display', 'as' => 'email_display']);
    Route::delete('/delete/{id}', [EmailDeleteController::class, 'email_delete', 'as' => 'email_delete']);
    Route::get('/paginate', [EmailPaginateController::class, 'email_paginate', 'as' => 'email_paginate']);
});

Route::prefix('/literature')->group(function () {
    Route::post('/create', [LiteratureCreateController::class, 'literature_create', 'as' => 'literature_create']);
    Route::post('/edit/{id}', [LiteratureEditController::class, 'literature_edit', 'as' => 'literature_edit']);
    Route::get('/display/{id}', [LiteratureDisplayController::class, 'literature_display', 'as' => 'literature_display']);
    Route::delete('/delete/{id}', [LiteratureDeleteController::class, 'literature_delete', 'as' => 'literature_delete']);
    Route::get('/paginate', [LiteraturePaginateController::class, 'literature_paginate', 'as' => 'literature_paginate']);
});

Route::prefix('/e-hundi')->group(function () {
    Route::post('/create', [EHundiCreateController::class, 'ehundi_create', 'as' => 'ehundi_create']);
    Route::put('/edit/{id}', [EHundiEditController::class, 'ehundi_edit', 'as' => 'ehundi_edit']);
    Route::get('/display/{id}', [EHundiDisplayController::class, 'ehundi_display', 'as' => 'ehundi_display']);
    Route::delete('/delete/{id}', [EHundiDeleteController::class, 'ehundi_delete', 'as' => 'ehundi_delete']);
    Route::get('/paginate', [EHundiPaginateController::class, 'ehundi_paginate', 'as' => 'ehundi_paginate']);
});

Route::prefix('/testimonial')->group(function () {
    Route::post('/create', [TestimonialCreateController::class, 'testimonial_create', 'as' => 'testimonial_create']);
    Route::put('/edit/{id}', [TestimonialEditController::class, 'testimonial_edit', 'as' => 'testimonial_edit']);
    Route::get('/display/{id}', [TestimonialDisplayController::class, 'testimonial_display', 'as' => 'testimonial_display']);
    Route::delete('/delete/{id}', [TestimonialDeleteController::class, 'testimonial_delete', 'as' => 'testimonial_delete']);
    Route::get('/paginate', [TestimonialPaginateController::class, 'testimonial_paginate', 'as' => 'testimonial_paginate']);
});

Route::prefix('/media')->group(function () {
    Route::post('/create', [MediaCreateController::class, 'media_create', 'as' => 'media_create']);
    Route::post('/edit/{id}', [MediaEditController::class, 'media_edit', 'as' => 'media_edit']);
    Route::get('/display/{id}', [MediaDisplayController::class, 'media_display', 'as' => 'media_display']);
    Route::delete('/delete/{id}', [MediaDeleteController::class, 'media_delete', 'as' => 'media_delete']);
    Route::get('/paginate', [MediaPaginateController::class, 'media_paginate', 'as' => 'media_paginate']);
});

Route::prefix('/banner')->group(function () {
    Route::post('/create', [BannerCreateController::class, 'banner_create', 'as' => 'banner_create']);
    Route::post('/edit/{id}', [BannerEditController::class, 'banner_edit', 'as' => 'banner_edit']);
    Route::get('/display/{id}', [BannerDisplayController::class, 'banner_display', 'as' => 'banner_display']);
    Route::delete('/delete/{id}', [BannerDeleteController::class, 'banner_delete', 'as' => 'banner_delete']);
    Route::get('/paginate', [BannerPaginateController::class, 'banner_paginate', 'as' => 'banner_paginate']);
});

Route::prefix('/user')->group(function () {
    Route::post('/password/{id}', [UserPasswordController::class, 'user_password', 'as' => 'user_password']);
    Route::get('/status/{id}', [UserStatusController::class, 'user_status', 'as' => 'user_status']);
    Route::get('/display/{id}', [UserDisplayController::class, 'user_display', 'as' => 'user_display']);
    Route::delete('/delete/{id}', [UserDeleteController::class, 'user_delete', 'as' => 'user_delete']);
    Route::get('/paginate', [UserPaginateController::class, 'user_paginate', 'as' => 'user_paginate']);
});

Route::prefix('/gallery-image')->group(function () {
    Route::post('/create', [GalleryImageCreateController::class, 'gallery_image_create', 'as' => 'gallery_image_create']);
    Route::post('/edit/{id}', [GalleryImageEditController::class, 'gallery_image_edit', 'as' => 'gallery_image_edit']);
    Route::get('/display/{id}', [GalleryImageDisplayController::class, 'gallery_image_display', 'as' => 'gallery_image_display']);
    Route::delete('/delete/{id}', [GalleryImageDeleteController::class, 'gallery_image_delete', 'as' => 'gallery_image_delete']);
    Route::get('/paginate', [GalleryImagePaginateController::class, 'gallery_image_paginate', 'as' => 'gallery_image_paginate']);
});

Route::prefix('/gallery-audio')->group(function () {
    Route::post('/create', [GalleryAudioCreateController::class, 'gallery_audio_create', 'as' => 'gallery_audio_create']);
    Route::post('/edit/{id}', [GalleryAudioEditController::class, 'gallery_audio_edit', 'as' => 'gallery_audio_edit']);
    Route::get('/display/{id}', [GalleryAudioDisplayController::class, 'gallery_audio_display', 'as' => 'gallery_audio_display']);
    Route::delete('/delete/{id}', [GalleryAudioDeleteController::class, 'gallery_audio_delete', 'as' => 'gallery_audio_delete']);
    Route::get('/paginate', [GalleryAudioPaginateController::class, 'gallery_audio_paginate', 'as' => 'gallery_audio_paginate']);
});

Route::prefix('/gallery-video')->group(function () {
    Route::post('/create', [GalleryVideoCreateController::class, 'gallery_video_create', 'as' => 'gallery_video_create']);
    Route::put('/edit/{id}', [GalleryVideoEditController::class, 'gallery_video_edit', 'as' => 'gallery_video_edit']);
    Route::get('/display/{id}', [GalleryVideoDisplayController::class, 'gallery_video_display', 'as' => 'gallery_video_display']);
    Route::delete('/delete/{id}', [GalleryVideoDeleteController::class, 'gallery_video_delete', 'as' => 'gallery_video_delete']);
    Route::get('/paginate', [GalleryVideoPaginateController::class, 'gallery_video_paginate', 'as' => 'gallery_video_paginate']);
});

});