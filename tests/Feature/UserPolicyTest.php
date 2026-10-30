<?php

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

function userForPolicy(int $id, string $role, string $status = 'active'): User
{
    return User::factory()->make([
        'role' => $role,
        'status' => $status,
    ])->forceFill(['id' => $id]);
}

function requestForPolicy(User $actor, User $target, array $payload): UserUpdateRequest
{
    $request = UserUpdateRequest::create('/users/'.$target->id, 'PUT', $payload);
    $request->setUserResolver(fn () => $actor);
    $request->setRouteResolver(fn () => new class($target)
    {
        public function __construct(private User $user) {}

        public function parameter(string $name, mixed $default = null): mixed
        {
            return $name === 'user' ? $this->user : $default;
        }
    });

    return $request;
}

it('allows only admins to view the user list', function () {
    $admin = userForPolicy(1, 'admin');
    $user = userForPolicy(2, 'user');

    expect($admin->can('viewAny', User::class))->toBeTrue()
        ->and($user->can('viewAny', User::class))->toBeFalse();
});

it('allows users to view and update their own profile', function () {
    $user = userForPolicy(1, 'user');
    $colleague = userForPolicy(2, 'user');

    expect($user->can('view', $user))->toBeTrue()
        ->and($user->can('update', $user))->toBeTrue()
        ->and($user->can('view', $colleague))->toBeFalse()
        ->and($user->can('update', $colleague))->toBeFalse();
});

it('allows admins to manage any user', function () {
    $admin = userForPolicy(1, 'admin');
    $user = userForPolicy(2, 'user');

    expect($admin->can('view', $user))->toBeTrue()
        ->and($admin->can('update', $user))->toBeTrue()
        ->and($admin->can('assignRole', $user))->toBeTrue()
        ->and($admin->can('changeStatus', $user))->toBeTrue()
        ->and($admin->can('delete', $user))->toBeTrue();
});

it('forbids non-admins from assigning roles and changing statuses', function () {
    $user = userForPolicy(1, 'user');

    expect($user->can('assignRole', $user))->toBeFalse()
        ->and($user->can('changeStatus', $user))->toBeFalse();
});

it('forbids admins from deleting themselves', function () {
    $admin = userForPolicy(1, 'admin');
    $otherAdmin = userForPolicy(2, 'admin');

    expect($admin->can('delete', $admin))->toBeFalse()
        ->and($admin->can('delete', $otherAdmin))->toBeTrue();
});

it('forbids a non-admin from escalating their own role', function () {
    $actor = userForPolicy(10, 'manager');
    $target = userForPolicy(10, 'manager');

    $request = requestForPolicy($actor, $target, [
        'role' => 'admin',
        'status' => 'active',
    ]);

    expect($request->authorize())->toBeFalse();
});

it('allows a non-admin to update their own profile without privilege changes', function () {
    $actor = userForPolicy(10, 'manager');
    $target = userForPolicy(10, 'manager');

    $request = requestForPolicy($actor, $target, [
        'role' => 'manager',
        'status' => 'active',
    ]);

    expect($request->authorize())->toBeTrue();
});
