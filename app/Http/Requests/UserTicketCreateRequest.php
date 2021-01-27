<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTicketCreateRequest extends FormRequest
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
            'title' => 'required|max:70',
            'category' => 'required',
            'priority' => 'required',
            'message' => 'required|max:700'
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
            'title.max' => __(':name should not be greater than :amount chars.', ['name' => "Title", 'amount' => "70"]),
            'message.max' => __(':name should not be greater than :amount chars.', ['name' => "Message", 'amount' => "700"]),

            'title.required' => __(':name is required!', ['name' => "Title"]),
            'category.required' => __(':name is required!', ['name' => "Category"]),
            'priority.required' => __(':name is required!', ['name' => "Priority"]),
            'message.required' => __(':name is required!', ['name' => "Message"]),
        ];
    }
}
