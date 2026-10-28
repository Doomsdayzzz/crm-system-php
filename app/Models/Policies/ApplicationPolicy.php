<?php

namespace App\Models\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{

    public function view(User $user, Application $application): bool
    {
        if ($user->isAdmin() || $user->id === $application->user_id) {
            return true;
        }
        return false;
    }

    public function update(User $user, Application $application): bool
    {
        if ($user->isAdmin() || $user->id === $application->user_id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Application $application): bool
    {
        if ($user->isAdmin() || $user->id === $application->user_id) {
            return true;
        }
        return false;
    }
}
