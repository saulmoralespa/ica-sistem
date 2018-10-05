<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'username' => 'required|unique:user,username',
            'email' => 'required|unique:user,email'
        ];
    }

    public function messages()
    {
        return [
            'username.unique:user' => 'El :attribute es obligatorio.',
        ];
    }
}
