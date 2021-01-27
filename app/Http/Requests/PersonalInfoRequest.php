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
            'birthday' => 'nullable|date_format:d/m/Y|before:today',
            'country' => 'nullable',
            'city' => 'nullable|max:50',
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
            'fullname.required' => __(':name is required', ['name' => "Full name"]),

            'email_address.required' => __(':name is required', ['name' => "Email address"]),
            'email_address.email' => __(':name format is invalid', ['name' => "Email address"]),
            'email_address.unique' => __(':name already exists', ['name' => "Email address"]),

            'phone_without_mask.min' => __(':name should not be less than :amount chars', ['name' => "Phone number", 'amount' => "6"]),
            'phone_without_mask.max' => __(':name should not be greater than :amount chars', ['name' => "Phone number", 'amount' => "13"]),

            'birthday.date_format' => __(':name date should be :date_format format', ['name' => "Birthday", 'date_format' => "d/m/Y"]),
            'birthday.before' => __(':name must be a date before :day', ['name' => "Birthday", 'day' => "today"]),

            'city.max' => __(':name should not be greater than :amount chars', ['name' => "Cities name", 'amount' => "50"]),
        ];
    }
}
