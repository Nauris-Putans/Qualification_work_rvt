<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileImageRequest extends FormRequest
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
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
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
            'profile_image.required' => __(':attribute - :action', ['attribute' => __("Profile image"), 'action' => __("is required!")]),
            'profile_image.image' => __(':attribute must be an image!', ['attribute' => __("Profile image")]),
            'profile_image.mimes' => __(':attribute must be a file of type: :image_types', ['attribute' => __("Profile image"), 'image_types' => ".jpeg, .png, .jpg!"]),
            'profile_image.max' => __(':attribute may not be greater than :amount kilobytes!', ['attribute' => __("Profile image"), 'amount' => "2048"]),
        ];
    }
}
