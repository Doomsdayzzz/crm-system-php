<?php

namespace App\Repository\User;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function getUsersPaginated(): LengthAwarePaginator;
    public function store(UserStoreRequest $userStoreRequest): ?User;
    public function update(UserUpdateRequest $userUpdateRequest, User $user): ?User;
    public function destroy(User $user): ?bool;
}
