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
            'current_password.required' => __(':attribute - :action', ['attribute' => __("Current password"), 'action' => __("is required!")]),
            'new_password.required' => __(':attribute - :action', ['attribute' => __("New password"), 'action' => __("is required!")]),
            'new_confirm_password.same' => __(':attribute_1 and :attribute_2 must match!', ['attribute_1' => __("New confirm password"), 'attribute_2' => __("new password")]),
            'new_confirm_password.different' => __(':attribute_1 and :attribute_2 must be different!', ['attribute_1' => __("New confirm password"), 'attribute_2' => __("current password")]),
        ];
    }
}
