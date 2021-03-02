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
            'checkAddress' => 'bail|required|min:5|max:200',
            'friendlyName' => 'max:20',
            'authenticationName' => 'max:20',
            'authenticationPassword' => 'max:20',
            'troubleshootingInstructions' => 'max:100'
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
            'checkAddress.required' => __('Check address should be filled out!'),
            'checkAddress.min' => __('Check address should contain more characters!'),
            'checkAddress.max' => __('Check address should contain less characters!'),

            'friendlyName.max' => __('Friendly name should contain less character!'),

            'authenticationName.max' => __('Authentication Name should contain less character!'),

            'authenticationPassword.max' => __('Authentication password should contain less character!'),

            'troubleshootingInstructions.max' => __('Troubleshooting instructions should contain less character!'),
        ];
    }
}
