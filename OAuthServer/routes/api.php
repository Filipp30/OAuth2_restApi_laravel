<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginWithFacebookController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\FbLoginController;
use App\Http\Controllers\Mollie\MollieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:facebook')->get('/user/fb',function (Request $request){
    return $request->user();
});


Route::post('/registration',[RegistrationController::class,'register']);

Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verify_email'])
    ->middleware(['verification.email','signed','throttle:5,1'])
    ->name('verification.verify');

Route::post('/resending/verify/email',[VerificationController::class,'resending_verify_email'])
    ->middleware('throttle:5,1');

Route::post('/login',[LoginController::class,'login']);
Route::post('/login/refresh',[LoginController::class,'refresh']);
Route::post('/logout',[LoginController::class,'logout'])->middleware('auth:api');

Route::get('/auth/redirect/facebook',[LoginWithFacebookController::class,'get_facebook_redirect_url']);
Route::get('/auth/callback/facebook',[LoginWithFacebookController::class,'auth_facebook_callback']);

//Mollie routes
Route::post('/create/order',[MollieController::class,'createOrder']);
Route::get('/redirect/callback/mollie',[MollieController::class,'redirectCallBack']);
Route::post('/webhook/callback/mollie',[MollieController::class,'webhookCallBack']);
