<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\MyFormRequest as FormRequest;

class LoginFormRequest extends FormRequest
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
            'login' => ['required', 'string', 'alpha_dash', 'between:4,24', 'regex: /^[A-Za-z].[A-Za-z0-9-_]+$/'],
            'password' => ['required', 'string', 'min:8', 'regex: /^[A-Za-z0-9](?=.*[0-9])(?=.*[A-Za-z])[A-Za-z0-9]{7,}$/'],
        ];
    }

    /**
     * Return error validate message.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute field is empty.',
            'message' => 'you cannot sign in with those credentials.',
            'password.regex' => 'password must have letters and numbers',
            'password.min' => 'password must have min 8 characters.',
        ];
    }
}

