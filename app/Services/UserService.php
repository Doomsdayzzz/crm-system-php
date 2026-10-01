<?php

namespace App\Services;

use App\Models\Application;
use App\Models\User;
use App\Repository\User\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    private const PER_PAGE = 10;

    public function __construct(
        private UserRepository $userRepository
    ){
    }

    public function getUserList(Request $request): array
    {
        return  [
            'countActiveUsers' => User::Filters($request)
                ->whereNotNull('users.email_verified_at')
                ->count(),
            'countDeactivatedUsers' => User::Filters($request)
                ->whereNull('users.email_verified_at')
                ->count(),
            'countApplications' => Application::query()->count(),
            'users' => User::Filters($request)
                ->with('applications')
                ->paginate(self::PER_PAGE)
       ];
    }
}
