<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'roleName' => 'required|max:50|unique:role_user,user_id',
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
            'roleName.required' => __(':attribute - :action', ['attribute' => __("Role name"), 'action' => __("is required!")]),
            'roleName.unique' => __(':attribute - :action', ['attribute' => __("Role name"), 'action' => __("already exists!")]),
            'roleName.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Role name"), 'amount' => "50"]),
            'roleDisplayName.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Role display name"), 'amount' => "50"]),
            'roleDesc.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Role description"), 'amount' => "100"]),
        ];
    }
}
