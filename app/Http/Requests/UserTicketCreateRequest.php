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
            'title.max' => __('Title should not be greater than 70 chars.'),
            'message.max' => __('Message should not be greater than 700 chars.'),

            'title.required' => __('Title is required!'),
            'category.required' => __('Category is required!'),
            'priority.required' => __('Priority is required!'),
            'message.required' => __('Message is required!'),
        ];
    }
}
