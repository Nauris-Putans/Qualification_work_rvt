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
            'permissionName.required' => 'Permission name is required.',
            'permissionName.unique' => 'This permission name already exist',
            'permissionName.max' => 'Permission name should not be greater than 50 chars.',
            'permissionDisplayName.max' => 'Permission display name should not be greater than 50 chars.',
            'permissionDesc.max' => 'Permission description should not be greater than 100 chars.',
        ];
    }
}
