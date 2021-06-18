<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'email' => ['required', 'string', 'email', 'max:30'],
            'password' => ['required', 'string','min:8','max:20'],
        ];
    }
}
