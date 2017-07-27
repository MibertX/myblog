<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required|max:100|min:2|unique:users',
            'email' => 'string|required|email|max:100|unique:users',
            'password' => 'string|required|min:6|max:18|confirmed',
            'password_confirmation' => 'string|same:password'
        ];
    }
}
