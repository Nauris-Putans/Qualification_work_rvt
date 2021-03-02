<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleAssignRequest extends FormRequest
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
            'role' => 'required',
            'member' => 'required'
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
            'role.required' => __('Select minimum :amount role!', ['amount' => "1"]),
            'member.required' => __(':attribute - :action', ['attribute' => __("Member"), 'action' => __("is required!")]),
        ];
    }
}
