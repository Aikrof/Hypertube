<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\MyFormRequest as FormRequest;
use App\Rules\EmailDomainRule;

class RegisterFormRequest extends FormRequest
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
            'login' => ['required', 'string', 'alpha_dash', 'between:4,24', 'regex: /^[A-Za-z].[A-Za-z0-9-_]+$/', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:64', 'unique:users', new EmailDomainRule],
            'password' => ['required', 'string', 'min:8', 'same:confirm', 'regex: /^[A-Za-z0-9](?=.*[0-9])(?=.*[A-Za-z])[A-Za-z0-9]{7,}$/'],
            'confirm' => ['required', 'string']
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
            'password.regex' => 'Password must have letters and numbers.',
            'password.min' => 'Password must have min 8 characters.',
            'same' => 'password and confirm must match.',
        ];
    }
}
