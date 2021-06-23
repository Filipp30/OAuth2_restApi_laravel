<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client as OClient;

class LoginController extends Controller{

    public function login(LoginUserRequest $request){
        $validated = $request->validated();
        $user = User::query()->where('email','=',$validated['email'])->first();
        $oClient = OClient::query()->where('password_client', 1)->first();

        if (!$user || !$oClient){
            return response([
                'message'=>'User or oClient not exist'
            ],401);
        }
        if (!Hash::check($validated['password'],$user->password)){
            return response([
                'message'=>'The provided credentials are incorrect.'
            ],401);
        }

        $req = Request::create('/oauth/token', 'POST',[
            'grant_type' => 'password',
            'client_id' =>$oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $validated['email'],
            'password' => $validated['password'],
            'scope' => ''
        ]);

        $response = app()->handle($req);
        $responseBody = json_decode($response->getContent());

        return response([
        'response'=>$responseBody,
        'user'=>$user,
        'isAdmin'=>$user['is_admin']
        ],201);
    }

    public function refresh(Request $request){
        $refresh_token = $request['refresh_token'];
        $oClient = OClient::query()->where('password_client', 1)->first();

        $req = Request::create('/oauth/token', 'POST',[
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'scope' => '',
        ]);

       $response = app()->handle($req);
       $responseBody = json_decode($response->getContent());

       if ($response->getStatusCode() == 401){
           return response([
               'response'=>$responseBody
           ],401);
       }
       return response([
           'response'=>$responseBody
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
