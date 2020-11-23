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
}
