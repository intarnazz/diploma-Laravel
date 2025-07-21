<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
        $userId = auth()->check() ? auth()->id() : null;

        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'string',
                Rule::unique('users')->ignore($userId),
            ],
            'name' => 'required|max:255|string',
            'phone' => 'required|max:30|string',
            'company' => 'required|max:255|string',
            'password' => 'required|max:255|string|min:3',
        ];
    }
}
