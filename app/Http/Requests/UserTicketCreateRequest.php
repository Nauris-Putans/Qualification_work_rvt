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
            'title.required' => __(':attribute - :action', ['attribute' => __("Title"), 'action' => __("is required!")]),
            'category.required' => __(':attribute - :action', ['attribute' => __("Category"), 'action' => __("is required!")]),
            'message.required' => __(':attribute - :action', ['attribute' => __("Message"), 'action' => __("is required!")]),

            'title.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Title"), 'amount' => "70"]),
            'message.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Message"), 'amount' => "700"]),
        ];
    }
}
