<?php

namespace Mixdinternet\Admix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUsersRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:150'
            , 'email' => 'required|email|unique:users'
            , 'password' => 'required|min:8|same:password-confirmation'
        ];
    }

    public function authorize()
    {
        return true;
    }
}