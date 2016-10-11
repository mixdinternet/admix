<?php
namespace Mixdinternet\Admix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:150'
            , 'password' => 'min:8|same:password-confirmation'
        ];
    }

    public function authorize()
    {
        return true;
    }
}