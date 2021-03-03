<?php

namespace App\Http\Requests;

use App\Rules\FullnameRule;
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
            'signup_name' => ['required', 'string', 'min:3', 'max:100', new FullnameRule()],
            'signup_email' => 'required|email:rfc,dns|string|min:10|max:100|unique:users,email',
            'signup_password' => 'required|string|min:8|max:100|confirmed'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'signup_name.required' => __(':attribute - :action', ['attribute' => __("Full name"), 'action' => __("is required!")]),
            'signup_email.required' => __(':attribute - :action', ['attribute' => __("Email"), 'action' => __("is required!")]),
            'signup_password.required' => __(':attribute - :action', ['attribute' => __("Password"), 'action' => __("is required!")]),

            'signup_name.string' => __(':attribute - :action', ['attribute' => __("Full name"), 'action' => __("is invalid!")]),
            'signup_email.email' => __(':attribute - :action', ['attribute' => __("Email"), 'action' => __("is invalid!")]),
            'signup_email.string' => __(':attribute - :action', ['attribute' => __("Email"), 'action' => __("is invalid!")]),
            'signup_password.string' => __(':attribute - :action', ['attribute' => __("Password"), 'action' => __("is invalid!")]),

            'signup_name.min' => __(':attribute should not be less than :amount chars!', ['attribute' => __("Full name"), 'amount' => "3"]),
            'signup_email.min' => __(':attribute should not be less than :amount chars!', ['attribute' => __("Email"), 'amount' => "10"]),
            'signup_password.min' => __(':attribute should not be less than :amount chars!', ['attribute' => __("Password"), 'amount' => "8"]),

            'signup_name.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Full name"), 'amount' => "100"]),
            'signup_email.max'=> __(':attribute should not be greater than :amount chars!', ['attribute' => __("Email"), 'amount' => "100"]),
            'signup_password.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Password"), 'amount' => "100"]),

            'signup_email.unique' => __(':attribute - :action', ['attribute' => __("Email"), 'action' => __("already exists!")]),
            'signup_password.confirmed' => __(':attribute - :action', ['attribute' => __("Confirm Password"), 'action' => __("do not match with password!")]),
        ];
    }
}
