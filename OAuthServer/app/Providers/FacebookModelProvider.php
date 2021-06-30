<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserFacebookCredentials;
use Illuminate\Support\ServiceProvider;

class FacebookModelProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot(){

        UserFacebookCredentials::creating(function($model){
            $user = User::query()->where('email','=',$model->email)->first();
            if ($user){
                $model->user_id = $user->id;
            }
        });
    }
}
