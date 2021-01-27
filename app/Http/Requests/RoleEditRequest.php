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
            'roleName.required' => __(':name is required.', ['name' => "Role name"]),
            'roleName.max' => __(':name should not be greater than :amount chars.', ['name' => "Role name", 'amount' => "50"]),
            'roleDisplayName.max' => __(':name should not be greater than :amount chars.', ['name' => "Role display name", 'amount' => "50"]),
            'roleDesc.max' => __(':name should not be greater than :amount chars.', ['name' => "Role description", 'amount' => "100"]),
        ];
    }
}
