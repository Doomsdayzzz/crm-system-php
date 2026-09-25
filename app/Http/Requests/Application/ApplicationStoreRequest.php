<?php

namespace App\Http\Requests\Application;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:8', 'unique:applications, title'],
            'description' => ['required', 'string', 'min:5', 'max:255'],
            'user_id'     => ['required', 'integer', 'exists:users,id'],
            'status'      => ['nullable', 'integer', 'in:0,1,2,3'],
        ];
    }
}

