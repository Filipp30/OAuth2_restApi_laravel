<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginWithFacebookController extends Controller{

    public function get_facebook_redirect_url(){
        return response(
            [
                'auth'=>Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl()
            ],
            201
        );
    }

    public function auth_facebook_callback(){
//        try {
//            $user = Socialite::driver('facebook')->user();
//            $isUser = User::query()->where('fb_id', $user->id)->first();

//            if ($isUser){
//                return response([
//                    'message'=>'user facebook in DB exist',
//                    'user_info_fb'=>$user,
//                    'user_info_db'=>$isUser
//                ],201);
//            }else{
//                return response([
//                    'message'=>'user not exist in us DB',
//                    'user_fb_info'=>$user,
//                    'password'=> encrypt('user')
//                ],201);
//            }

//            return redirect('/user');

//        }catch (Exception $e){
//            dd($e->getMessage());
//        }
        $user =  Socialite::driver('facebook')->stateless()->user();
        dd($user);
//        return view('user',['user'=>$user->email]);
    }

    public function test(){
        return 'Hello Wolrd!!!';
    }
}
