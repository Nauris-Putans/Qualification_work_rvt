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
            'permissionName.required' => __(':attribute - :action', ['attribute' => __("Permission name"), 'action' => __("is required!")]),
            'permissionName.unique' => __(':attribute - :action', ['attribute' => __("Permission name"), 'action' => __("already exists!")]),
            'permissionName.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Permission name"), 'amount' => "50"]),
            'permissionDisplayName.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Permission display name"), 'amount' => "50"]),
            'permissionDesc.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Permission description"), 'amount' => "100"]),
        ];
    }
}
