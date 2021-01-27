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
            'profile_image.required' => __(':name is required', ['name' => "Profile Image"]),
            'profile_image.image' => __(':name must be an image', ['name' => "Profile Image"]),
            'profile_image.mimes' => __(':name must be a file of type: :image_types', ['name' => "Profile Image", 'image_types' => ".jpeg, .png, .jpg"]),
            'profile_image.max' => __(':name may not be greater than :amount kilobytes', ['name' => "Profile Image", 'amount' => "2048"]),
        ];
    }
}
