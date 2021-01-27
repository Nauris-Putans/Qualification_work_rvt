<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionAddRequest extends FormRequest
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
            'permissionName' => 'required|unique:permissions,name|max:50',
            'permissionDisplayName' => 'max:50',
            'permissionDesc' => 'max:100',
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
            'permissionName.required' => __(':name is required.', ['name' => "Permission name"]),
            'permissionName.unique' => __('This :name already exist', ['name' => "permission name"]),
            'permissionName.max' => __(':name should not be greater than :amount chars.', ['name' => "Permission name", 'amount' => "50"]),
            'permissionDisplayName.max' => __(':name should not be greater than :amount chars.', ['name' => "Permission display name", 'amount' => "50"]),
            'permissionDesc.max' => __(':name should not be greater than :amount chars.', ['name' => "Permission description", 'amount' => "100"]),
        ];
    }
}
