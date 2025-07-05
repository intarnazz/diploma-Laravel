<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestQueryRequest extends FormRequest
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
            "name" => "nullable",
            "email" => "nullable|email",
            "phone" => "nullable",
            "company" => "required",
            "description" => "required",
            "content" => "nullable|max:2000",
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (empty($this->email) && empty($this->phone)) {
                $validator->errors()->add('email', 'Either email or phone must be provided.');
                $validator->errors()->add('phone', 'Either phone or email must be provided.');
            }
        });
    }
}
