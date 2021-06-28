<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserFacebookCredentials;

class UserObserver{

    public function created(User $user){
        UserFacebookCredentials::query()
        ->where('email','=',$user->email)
        ->first()->update(['user_id'=>$user->id]);
    }


    public function updated(User $user)
    {
        //
    }


    public function deleted(User $user)
    {
        //
    }


    public function restored(User $user)
    {
        //
    }


    public function forceDeleted(User $user)
    {
        //
    }
}
