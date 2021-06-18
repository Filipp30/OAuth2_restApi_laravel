<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller{

    public function verify_email(Request $request){
        $user = User::query()->findOrFail($request->id);
        $email_is_verified = $user->markEmailAsVerified();
        if ($email_is_verified){
            return response('Email is verified successfully.');
        }
    }

}
