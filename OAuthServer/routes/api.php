<?php

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registration',[RegistrationController::class,'register']);

Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verify_email'])
    ->middleware(['verification.email','signed', 'throttle:10,1'])
    ->name('verification.verify');
