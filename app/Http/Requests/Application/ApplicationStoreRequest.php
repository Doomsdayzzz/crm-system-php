<?php

namespace App\Http\Requests\Application;

use App\Enums\ApplicationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationStoreRequest extends FormRequest
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

    /**
     * Кастомные сообщения об ошибках на русском языке.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Поле «Название» обязательно для заполнения.',
            'title.string' => 'Поле «Название» должно быть строкой.',
            'title.max' => 'Название не должно превышать :max символов.',

            'description.string' => 'Поле «Описание» должно быть строкой.',
            'description.max' => 'Описание не должно превышать :max символов.',

            'department_id.required' => 'Выберите отдел.',
            'department_id.integer' => 'Выберите отдел из списка.',
            'department_id.exists' => 'Выбранный отдел не существует.',

            'user_id.integer' => 'Выберите ответственного из списка.',
            'user_id.exists' => 'Выбранный пользователь не существует.',

            'status.required' => 'Выберите статус заявки.',
            'status.integer' => 'Статус заявки указан некорректно.',
            'status.in' => 'Статус заявки должен быть одним из: :values.',
        ];
    }

    /**
     * Русские названия атрибутов (для подстановки в сообщения).
     */
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
