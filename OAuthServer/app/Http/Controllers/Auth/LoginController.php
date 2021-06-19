<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
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

            $req = Request::create('/oauth/token', 'POST',[
                'grant_type' => 'password',
                'client_id' => 5,
                'client_secret' => 'AiyRwhHOt4wgYi4DERinnJArQ4pDMQQzX6cQgePl',
                'username' => $validated['email'],
                'password' => $validated['password'],
                'scope' => ''
            ]);
            $response = app()->handle($req);
            $responseBody = json_decode($response->getContent());

            return response([
            'response'=>$responseBody,
            'isAdmin'=>$user['is_admin']
        ],201);
    }



















    public function login_refresh(){

    }


    public function logout(){
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response([
            'message'=>'logout successfully'
        ],201);
    }
}
