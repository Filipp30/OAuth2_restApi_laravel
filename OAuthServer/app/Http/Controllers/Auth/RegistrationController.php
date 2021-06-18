<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegistrationController extends Controller
{
    public function register(RegistrationUserRequest $request){
        $validated = $request->validated();

        $user = User::query()->create
        ([
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'phone_number'=>$validated['phone_number'],
            'password' => Hash::make($validated['password'])
        ]);

        if ($user){
            event(new Registered($user));
        }

        return response([
            'message'=>'Email or phone verification needed.',
            'user'=>$user,
        ],201);
    }




}
