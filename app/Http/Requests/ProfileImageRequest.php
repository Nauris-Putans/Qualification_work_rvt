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
            'profile_image.required' => __('Profile Image is required'),
            'profile_image.image' => __('Profile Image must be an image'),
            'profile_image.mimes' => __('Profile Image must be a file of type: .jpeg, .png, .jpg'),
            'profile_image.max' => __('Profile Image may not be greater than 2048 kilobytes'),
        ];
    }
}
