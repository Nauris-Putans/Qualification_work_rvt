<?php

namespace App\Http\Requests;

use App\Rules\FullnameRule;
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
            'fullname' => ['required', new FullnameRule()],
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
            'title.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Title"), 'amount' => "100"]),
            'fullname.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Full name"), 'amount' => "100"]),
            'email.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Email"), 'amount' => "100"]),
            'message.max' => __(':attribute should not be greater than :amount chars!', ['attribute' => __("Message"), 'amount' => "1000"]),

            'title.required' => __(':attribute - :action', ['attribute' => __("Title"), 'action' => __("is required!")]),
            'category.required' => __(':attribute - :action', ['attribute' => __("Category"), 'action' => __("is required!")]),
            'fullname.required' => __(':attribute - :action', ['attribute' => __("Full name"), 'action' => __("is required!")]),
            'email.required' => __(':attribute - :action', ['attribute' => __("Email"), 'action' => __("is required!")]),
            'message.required' => __(':attribute - :action', ['attribute' => __("Message"), 'action' => __("is required!")]),

            'email.email' => __(':attribute - :action', ['attribute' => __("Email"), 'action' => __("is invalid!")]),
        ];
    }
}
