<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\ContactTypeValueRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        $target = $this->route('user');

        if (! $target instanceof User) {
            return false;
        }

        $user = $this->user();

        if (! $user?->can('update', $target)) {
            return false;
        }

        return ! $this->changesPrivileges($target)
            || ($user->can('assignRole', $target) && $user->can('changeStatus', $target));
    }

    /**
     * Determine whether the request tries to change the role or the status of the user.
     */
    private function changesPrivileges(User $target): bool
    {
        $changesRole = $this->has('role') && $this->input('role') !== $target->role;
        $changesStatus = $this->has('status') && $this->input('status') !== $target->status;

        return $changesRole || $changesStatus;
    }

    public function rules(): array
    {
        //        dd($this);
        return [
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:255', 'unique:users,email,'.$this->route()->parameter('user')->id],
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
            'contact_types' => ['sometimes', 'array'],
            'contact_types.*.id' => ['integer', 'exists:contact_types,id'],
            'contact_types.*.value' => ['string', new ContactTypeValueRule],

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
