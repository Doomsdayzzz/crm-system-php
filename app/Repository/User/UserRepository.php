<?php

namespace App\Repository\User;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private const PER_PAGE = 10;

    public function getUsersPaginated(): LengthAwarePaginator
    {
        return User::query()
            ->with('applications')
            ->paginate(self::PER_PAGE);
    }

    public function store(UserStoreRequest $userStoreRequest): ?User
    {
        $validated['password'] = Hash::make($userStoreRequest->password);
        return User::query()->create($validated);
    }

    public function update(UserUpdateRequest $userUpdateRequest, User $user): ?User
    {
        if ($userUpdateRequest->password) {
            $user->password = Hash::make($userUpdateRequest->password);
        }

        $user->name = $userUpdateRequest->name;
        $user->email = $userUpdateRequest->email;
        $user->save();

        return $user;
    }

    public function destroy(User $user): ?bool
    {
        return $user->delete();
    }
}
