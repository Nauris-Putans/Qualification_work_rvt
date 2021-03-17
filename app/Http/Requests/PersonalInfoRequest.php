<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FullnameRule;
use Illuminate\Support\Facades\Auth;

class PersonalInfoRequest extends FormRequest
{
    // protected $errorBag = 'personal_info';

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
            'fullname' => ['required', new FullnameRule()],
            'email_address' => 'required|email:rfc,dns|unique:users,email,' . Auth::id(),
            'phone_without_mask' => 'nullable|min:6|max:13',
            'gender' => 'nullable',
            'country' => 'nullable',
            'city' => 'nullable|max:50',
            'birthday' => 'nullable|before:today|after:01/01/1940',
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
            'fullname.required' => __(':attribute - :action', ['attribute' => __("Full name"), 'action' => __("is required!")]),

            'email_address.required' => __(':attribute - :action', ['attribute' => __("Email"), 'action' => __("is required!")]),
            'email_address.email' => __(':attribute format :action', ['attribute' => __("Email"), 'action' => __("is invalid!")]),
            'email_address.unique' => __(':attribute - :action', ['attribute' => __("Email"), 'action' => __("already exists!")]),

            'phone_without_mask.min' => __(':attribute should not be less than :amount chars!', ['attribute' => __("Phone number"), 'amount' => "6"]),
            'phone_without_mask.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Phone number"), 'amount' => "13"]),

            'birthday.date_format' => __(':attribute date should be :date_format format!', ['attribute' => __("Birthday"), 'date_format' => "d/m/Y"]),
            'birthday.before' => __(':attribute must be a date before :day', ['attribute' => __("Birthday"), 'day' => __("today") . "!"]),
            'birthday.after' => __(':attribute must be a date after :day', ['attribute' => __("Birthday"), 'day' => __("01/01/1940") . "!"]),

            'city.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Cities name"), 'amount' => "50"]),
        ];
    }
}
