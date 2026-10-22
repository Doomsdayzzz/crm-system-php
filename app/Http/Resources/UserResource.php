<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->isAdmin() ? 'Админ' : 'Пользователь',
            'status' => $this->status ? 'Активен' : 'Не активен',
            'avatar' => $this->avatar,
            'created_at' => $this->created_at,
            'applications' => $this->applications
        ];
    }
}
