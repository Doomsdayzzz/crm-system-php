<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\ContactType;
use App\Models\User;
use App\Repository\User\UserRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserRepository $userRepository,
        private UserService $userService
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(Request $request): View
    {
        return view('users.index', $this->userService->getUserList($request));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(
        UserStoreRequest $userStoreRequest
    ): RedirectResponse {

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
            'user' => $user->load(['applications', 'images', 'contactTypes']),
            'contactTypes' => ContactType::all(),
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
        User $user
    ): RedirectResponse {
        $this->userRepository->update($userUpdateRequest, $user);

        return redirect()
            ->back()
            ->with('success', 'User updated successfully.');
    }
}
