<?php
namespace App\Http\Requests;

use App;
use Illuminate\Foundation\Http\FormRequest;

class EditUsersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = App::make('currentUser');

        return [
            'name' => 'required|max:150'
            , 'email' => 'required|email|unique:users,email,' . $userId
            , 'password' => 'min:8|same:password-confirmation'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}