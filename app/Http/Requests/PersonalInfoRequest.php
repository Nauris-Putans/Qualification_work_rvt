<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FullnameRule;

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
            'email_address' => 'exclude_if:email,null|required|email:rfc,dns|unique:users,email',
            'phone_without_mask' => 'nullable|min:6|max:13',
            'gender' => 'nullable',
            'birthday' => 'nullable|date_format:m/d/Y|before:today',
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
            'fullname.required' => __('Full name is required'),

            'email_address.required' => __('Email address is required'),
            'email_address.email' => __('Email address format is invalid'),
            'email_address.unique' => __('Email address already exists'),

            'phone_without_mask.min' => __('Phone number should not be less than 6 chars'),
            'phone_without_mask.max' => __('Phone number should not be greater than 13 chars'),

            'birthday.date_format' => __('Birthday date should be m/d/Y format'),
            'birthday.before' => __('Birthday must be a date before today'),

            'city.max' => __('Cities name should not be greater than 50 chars'),
        ];
    }
}
