<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactCreateRequest extends FormRequest
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
            'fullname' => 'required|max:100',
            'email' => 'required|max:100',
            'message' => 'required|max:255',
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
            'fullname.max' => __('Fullname should not be greater than 100 chars.'),
            'email.max' => __('Email should not be greater than 100 chars.'),
            'message.max' => __('Message should not be greater than 255 chars.'),
        ];
    }
}
