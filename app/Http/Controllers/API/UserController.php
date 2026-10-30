<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use App\Repository\User\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        private UserRepository $userRepository
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(): UserResourceCollection
    {
        return UserResourceCollection::make(User::query()->with(['applications'])->get());
    }

    public function show(User $user): UserResource
    {
        return UserResource::make($user);
    }

    public function store(
        UserStoreRequest $userStoreRequest
    ): UserResource|JsonResponse {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->store($userStoreRequest);
            DB::commit();

            return UserResource::make(
                $user
            );
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return response()->json([
            'message' => $exception->getMessage(),
        ], $exception->getCode());
    }

    public function update(
        UserUpdateRequest $userUpdateRequest,
        User $user
    ): UserResource|JsonResponse {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->update($userUpdateRequest, $user);
            DB::commit();

            return UserResource::make(
                $user
            );
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return response()->json([
            'message' => $exception->getMessage(),
        ], $exception->getCode());
    }

    public function destroy(User $user): JsonResponse
    {
        return response()->json([
            'message' => 'Пользователь удален!',
            'status' => $this->userRepository->destroy($user),
        ], 200);
    }
}
