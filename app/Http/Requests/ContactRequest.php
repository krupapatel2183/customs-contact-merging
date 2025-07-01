<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:255',
            'email'           => 'required|email',
            'phone' => [
                'required',
                'string',
                'regex:/^\+\d{1,3}\d{7,14}$/',
                'max:20'
            ],
            'gender'          => 'nullable|in:Male,Female,Other',
            'profile_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_file' => 'nullable|file|max:5120',
        ];
    }

    public function messages(){
        return [
            'phone.regex' => 'The phone number must be in international format (e.g., +1234567890).'
        ];
    }
}
