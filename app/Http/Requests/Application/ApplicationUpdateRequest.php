<?php

namespace App\Http\Requests\Application;

use App\Enums\ApplicationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'status' => ['required', 'integer', 'in:'.implode(',', ApplicationStatusEnum::values())],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле «Название» обязательно для заполнения.',
            'title.max' => 'Название не должно превышать :max символов.',

            'department_id.required' => 'Выберите отдел.',
            'department_id.exists' => 'Выбранный отдел не существует.',

            'user_id.exists' => 'Выбранный пользователь не существует.',

            'status.required' => 'Выберите статус заявки.',
            'status.in' => 'Статус заявки должен быть одним из: :values.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Название',
            'description' => 'Описание',
            'department_id' => 'Отдел',
            'user_id' => 'Ответственный',
            'status' => 'Статус',
        ];
    }
}
