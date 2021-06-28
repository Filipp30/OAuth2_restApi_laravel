<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserFacebookCredentials;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class LoginWithFacebookController extends Controller{

    private $callback_credentials;
    private $fb_user_exist;
    private $save_fb_credentials;

    public function get_facebook_redirect_url(){
        return response(['redirect_fb_url'=>Socialite::driver('facebook')
        ->stateless()->redirect()->getTargetUrl()], 201);
    }

    public function auth_facebook_callback(){
        try {
            $this->callback_credentials = Socialite::driver('facebook')->stateless()->user();
            $this->handle_fb_credentials();
        }catch (Exception $e){
            dd($e->getMessage());
        }
    }

    public function handle_fb_credentials(){

        $this->fb_user_exist = UserFacebookCredentials::query()
        ->where('fb_id','=',$this->callback_credentials->id)->first();

        if (!$this->fb_user_exist){
            $this->save_fb_credentials = UserFacebookCredentials::query()->create([
                'fb_id'=>$this->callback_credentials->id,
                'nickname'=>$this->callback_credentials->nickname,
                'name'=>$this->callback_credentials->name,
                'email'=>$this->callback_credentials->email,
                'avatar'=>$this->callback_credentials->avatar_original,
                'fb_profile_url'=>$this->callback_credentials->profileUrl
            ])->save();
        }

        if ($this->fb_user_exist || $this->save_fb_credentials){
            dd($this->fb_user_exist , $this->save_fb_credentials);
            //response with Tokens
        }
    }

}
