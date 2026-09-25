<?php

namespace App\Services;

use App\Models\Application;
use App\Models\User;
use App\Repository\User\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ){
    }

    public function getUserList(): array
    {
      return  [
            'countActiveUsers' => User::query()
                ->select(['users.id'])
                ->whereNotNull('users.email_verified_at')
                ->count(),
            'countDeactivatedUsers' => User::query()
                ->select(['users.id'])
                ->whereNull('users.email_verified_at')
                ->count(),
            'countApplications' => Application::query()
                ->count(),
            'users' => $this->userRepository->getUsersPaginated()
        ];
    }
}
