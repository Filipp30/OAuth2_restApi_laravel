<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFacebookCredentials extends Model{
    use HasFactory;

    protected $table = 'user_facebook_credentials';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'fb_id',
        'nickname',
        'name',
        'email',
        'avatar',
        'fb_profile_url'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
