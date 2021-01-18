<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMonitorsAdd extends FormRequest
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
            'checkField' => 'bail|min:5|required|max:90',
            'friendlyName' => 'max:90',
            'authenticationName' => 'max:60',
            'authenticationPassword' => 'max:60',
            'troubleshootingInstructions' => 'max:90'
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
            'checkField.bail' => __('gejs'),
            'checkField.min' => __('gejs'),

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
