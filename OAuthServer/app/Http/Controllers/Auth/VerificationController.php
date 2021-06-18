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

//        if (!$user){
//            dd('User not exists');
//        }
        $hash = hash_equals($request->hash , sha1($user->getEmailForVerification()));

//        if (!$hash){
//            dd('Hash credentials are incorrect!');
//        }
//
//        if ($user->hasVerifiedEmail()){
//            dd('Email is verified');
//        }
//
//        $user->markEmailAsVerified();

        dd($user->getEmailForVerification(),
            $request->hash,
            sha1($user->getEmailForVerification()),
            $hash,
            $request->signature,
            $request->expires
            );

    }


}
