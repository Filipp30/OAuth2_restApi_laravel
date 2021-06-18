<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller{


    public function login(LoginUserRequest $request){
        $validated = $request->validated();

        $user = User::query()->where('email','=',$validated['email'])->first();

        if (! $user){
            return response([
                'message'=>'User not exist'
            ],401);
        }
        if (!Hash::check($validated['password'],$user->password)){
            return response([
                'message'=>'The provided credentials are incorrect.'
            ],401);
        }

//        $tokens = $user->
        return response([
            'access_token'=>$user->createToken('access_token')->accessToken,

            'isAdmin'=>$user['is_admin']
        ],201);
    }

    public function logout(){
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response([
            'message'=>'logout successfully'
        ],201);
    }
}
