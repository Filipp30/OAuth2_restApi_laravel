<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\OAuthClient\PasswordOAuthClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;

class LoginController extends Controller{

    public function login(LoginUserRequest $request,PasswordOAuthClient $client){

        $validated = $request->validated();
        $user = User::query()->where('email','=',$validated['email'])->first();
        if (!$user){
            return response([
                'message'=>'User not exist'
            ],401);
        }
        if (!Hash::check($validated['password'],$user->password)){
            return response([
                'message'=>'The provided credentials are incorrect.'
            ],401);
        }
        $tokens = $client->getAccessTokenAndRefreshToken($validated['email'],$validated['password']);

        if (!$tokens){
            return response([
                'response'=>'OAuthClient is invalid.'
            ],401);
        }
        return response([
        'response'=>$tokens,
        'user'=>$user,
        'isAdmin'=>$user['is_admin']
        ],201);
    }


    public function refresh(Request $request,PasswordOAuthClient $client){

        $refresh_token = $request['refresh_token'];
        $new_tokens = $client->refreshTokens($refresh_token);

        if (!$new_tokens){
            return response([
                'response'=>'The refresh token is invalid.'
            ],401);
        }
        return response([
           'response'=>$new_tokens
        ],201);
    }


    public function logout(Request $request){

        $access_token_id = $request->user()->token()->id;
        $tokenRepository = app(TokenRepository::class);
        $refreshTokenRepository = app(RefreshTokenRepository::class);

        $revoke_status = $tokenRepository->revokeAccessToken($access_token_id);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($access_token_id);

        if (!$revoke_status){
            return response([
                'revoke_status'=>'Error:revoke status: FALSE'
            ],401);
        }
        return response([
            'revoke_status'=>$revoke_status,
            'message'=>'logout successfully.'
        ],201);
    }
}
