<?php

namespace Mixdinternet\Admix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:150'
            , 'rules' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}