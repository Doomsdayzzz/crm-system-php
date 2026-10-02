<?php

namespace App\Repository\User;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Models\Image;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $validated = $userStoreRequest->validated();

        $validated['password'] = Hash::make($userStoreRequest->password);
        return User::query()->create($validated);
    }

    public function update(UserUpdateRequest $userUpdateRequest, User $user): ?User
    {
        if ($userUpdateRequest->filled('password')) {
            $user->password = Hash::make($userUpdateRequest->password);
        }
        if ($userUpdateRequest->contact_types) {
            $syncData = [];
            foreach ($userUpdateRequest->contact_types as $contactType) {
                $syncData[$contactType['id']] = [
                    'subject' => $contactType['value'],
                ];
            }
            $user->contactTypes()->sync($syncData);
        }


        $user->name     = $userUpdateRequest->name;
        $user->email    = $userUpdateRequest->email;
        $user->role     = $userUpdateRequest->role;
        $user->status   = $userUpdateRequest->status;
        $user->phone    = $userUpdateRequest->phone;
        $user->position = $userUpdateRequest->position;
        $user->notes    = $userUpdateRequest->notes;

        if ($userUpdateRequest->hasFile('avatar')) {
            $user->avatar = $userUpdateRequest->file('avatar')->store('avatars', 'public');
        }

        if ($userUpdateRequest->hasFile('images')) {
            foreach ($userUpdateRequest->file('images') as $file) {
                Image::create([
                    'user_id' => $user->id,
                    'path'    => $file->store('images/' . $user->id . '/', 'public'),
                    'name'    => $file->getClientOriginalName(),
                    'disk'    => 'public',
                ]);
            }
        }


        if ($userUpdateRequest->has('remove_images')) {
            foreach ((array) $userUpdateRequest->input('remove_images', []) as $id) {
                $image = Image::find($id);
                if (! $image) {
                    continue;
                }

                if (Storage::disk($image->disk)->exists($image->path)) {
                    Storage::disk($image->disk)->delete($image->path);
                }

                $image->delete();
            }
        }


        $privateIds = (array) $userUpdateRequest->input('change_private_images', []);

        foreach ($user->images()->get() as $image) {
            $shouldBePrivate = in_array((string) $image->id, array_map('strval', $privateIds), true);

            if ($shouldBePrivate && $image->disk === 'public') {
                // public -> private
                if (Storage::disk('public')->exists($image->path)) {
                    $content = Storage::disk('public')->get($image->path);
                    Storage::disk('private')->put($image->path, $content);
                    Storage::disk('public')->delete($image->path);
                }
                $image->disk = 'private';
                $image->save();
            } elseif (! $shouldBePrivate && $image->disk === 'private') {
                // private -> public
                if (Storage::disk('private')->exists($image->path)) {
                    $content = Storage::disk('private')->get($image->path);
                    Storage::disk('public')->put($image->path, $content);
                    Storage::disk('private')->delete($image->path);
                }
                $image->disk = 'public';
                $image->save();
            }
        }

        $user->save();

        return $user;
    }

    public function destroy(User $user): ?bool
    {
        return $user->delete();
    }
}
