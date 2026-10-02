<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
//        dd($this);
        return [
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:255', 'unique:users,email,' . $this->route()->parameter('user')->id],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255', 'in:admin,user'],
            'status' => ['required', 'string', 'in:active,inactive,pending'],
            'phone' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:4096',
            'remove_images' => 'sometimes|array',
            'change_private_images' => 'sometimes|array',
            'statuses' => 'sometimes|array',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Такая почта уже существует!',
            'password.confirmed' => 'Пароли не совпадают!',
        ];
    }
}
