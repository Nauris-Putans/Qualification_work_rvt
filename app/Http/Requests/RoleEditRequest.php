<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleEditRequest extends FormRequest
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
            'roleName' => 'required|max:50',
            'roleDisplayName' => 'max:50',
            'roleDesc' => 'max:100',
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
            'roleName.required' => __('Role name is required.'),
            'roleName.max' => __('Role name should not be greater than 50 chars.'),
            'roleDisplayName.max' => __('Role display name should not be greater than 50 chars.'),
            'roleDesc.max' => __('Role description should not be greater than 100 chars.'),
        ];
    }
}
