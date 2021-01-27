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
            'title' => 'required|max:100',
            'category' => 'required',
            'fullname' => 'required|max:100',
            'email' => 'required|email:rfc,dns|max:100',
            'message' => 'required|max:1000',
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
            'title.max' => __(':name should not be greater than :amount chars.', ['name' => "Title", 'amount' => "100"]),
            'fullname.max' => __(':name should not be greater than :amount chars.', ['name' => "Fullname", 'amount' => "100"]),
            'email.max' => __(':name should not be greater than :amount chars.', ['name' => "Email", 'amount' => "100"]),
            'message.max' => __(':name should not be greater than :amount chars.', ['name' => "Message", 'amount' => "1000"]),

            'title.required' => __(':name is required!', ['name' => "Title"]),
            'category.required' => __(':name is required!', ['name' => "Category"]),
            'fullname.required' => __(':name is required!', ['name' => "Fullname"]),
            'email.required' => __(':name is required!', ['name' => "Email"]),
            'message.required' => __(':name is required!', ['name' => "Message"]),

            'email.email' => __(':name is invalid', ['name' => "Email"]),
        ];
    }
}
