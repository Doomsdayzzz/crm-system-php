<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:255', 'unique:users,email,' . $this->route()->parameter('user')->id], //исключаем проверку по сомому себе для валиатора, иначе не даст сохнанить форму (подробнее видео 08092026 - 01:56:14)
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Такая почта уже существует!',
            'password.confirmed' => 'Пароли не совпадают!'
        ];
    }
}
