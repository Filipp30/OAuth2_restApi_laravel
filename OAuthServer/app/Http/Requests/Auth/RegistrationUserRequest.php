<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationUserRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules()
    {
        return [
            'user_name' => ['required','string','max:30'],
            'email' => ['required','string','email','unique:users','max:30'],
            'phone_number'=>['required','numeric','unique:users'],
            'password' => ['required','string','confirmed','min:8','max:20'],
        ];
    }
}
