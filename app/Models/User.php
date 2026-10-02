<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string $phone
 * @property string $position
 * @property string $notes
 * @property string $avatar
 * @property string $status
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Application> $applications
 * @property-read int|null $applications_count
 * @property Collection<int, Image> $images
 * @property int|null $images_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User Filters(Request $request)
 * @mixin \Eloquent
 */
#[Fillable(['name', 'email', 'password', 'role', 'status', 'phone', 'position', 'notes','avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function isAdmin(): bool
    {
        return $this->role == 'admin';
    }

    public function isUser(): bool
    {
        return $this->role == 'user';
    }

    public function roleLabel(): string
    {
        switch ($this->role) {
            case 'admin':
                return 'Администратор';
            case 'user':
                return 'Пользователь';
            default:
                return 'Оно';
        }
    }

    public function scopeFilters(Builder $builder, Request $request): Builder
    {
        if($request->status =='all'){
            return $builder;
        }

        return $builder
//            ->when(!is_null($request->status) && in_array($request->status, [0, 1]), function (Builder $builder) use ($request) {
//                $builder->where('status', $request->status);
//            })
            ->when($request->search, function (Builder $builder) use ($request) {
                $builder->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->when($request->sortBy, function (Builder $builder) use ($request) {
                $allowedSortFields = ['name', 'email', 'created_at'];
                $sortField = in_array($request->sortBy, $allowedSortFields) ? $request->sortBy : 'created_at';
                $builder->orderBy($sortField, $request->sortDirection ?? 'desc');
            })
            ->when($request->status, function (Builder $builder) use ($request) {
                $builder->where('status', $request->status);
            });
    }

}
