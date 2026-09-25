<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Repository\User\UserRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserRepository $userRepository,
        private UserService    $userService
    ){}

    public function index(): View
    {
        return view('users.index', $this->userService->getUserList());
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(
        UserStoreRequest $userStoreRequest
    ): RedirectResponse
    {
        return redirect()
            ->route(
                'users.edit',
                $this->userRepository->store($userStoreRequest)
            )
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userRepository->destroy($user);
        return redirect()
            ->route('users.index')
            ->with('success', 'User destroy successfully.');
    }

    public function update(
        UserUpdateRequest $userUpdateRequest,
        User              $user
    ): RedirectResponse
    {
        return redirect()
            ->route(
                'users.edit',
                $this->userRepository->update($userUpdateRequest, $user)
            )->with('success', 'User updated successfully.');
    }
}
