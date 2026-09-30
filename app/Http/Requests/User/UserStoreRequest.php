<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:admin,user'],
        ];
    }
}
