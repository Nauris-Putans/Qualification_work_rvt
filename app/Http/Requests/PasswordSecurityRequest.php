<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class PasswordSecurityRequest extends FormRequest
{
    // protected $errorBag = 'password_security';

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
            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password', 'different:current_password'],
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
            'current_password.required' => __(':name is required!', ['name' => "Current password"]),
            'new_password.required' => __(':name is required!', ['name' => "New password"]),
            'new_confirm_password.same' => __(':name_1 and :name_2 must match', ['name_1' => "New confirm password", 'name_2' => "new password"]),
            'new_confirm_password.different' => __(':name_1 and :name_2 must be different', ['name_1' => "New confirm password", 'name_2' => "current password"]),
        ];
    }
}
