<?php

namespace App\Models;

use App\Enums\ApplicationStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $status
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Department|null $department
 * @property-read User|null $user
 *
 * @method static \Database\Factories\ApplicationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereUserId($value)
 *
 * @mixin \Eloquent
 */
#[Fillable('title', 'description', 'user_id', 'status', 'department_id')]
class Application extends Model
{
    use HasFactory;

    //    protected $fillable = [
    //        'title', 'description', 'user_id', 'status'
    //    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Статус заявки в виде enum (fallback — «Новая» для устаревших значений).
     */
    public function statusEnum(): ApplicationStatusEnum
    {
        return ApplicationStatusEnum::tryFrom((int) $this->status) ?? ApplicationStatusEnum::NEW;
    }

    /**
     * Фильтрация списка заявок по названию, статусу и отделу.
     */
    public function scopeFilters(Builder $builder, Request $request): Builder
    {
        return $builder
            ->when(
                $request->filled('search'),
                fn (Builder $b) => $b->where('title', 'like', '%'.$request->search.'%')
            )
            ->when(
                $request->filled('status') && in_array((int) $request->status, ApplicationStatusEnum::values()),
                fn (Builder $b) => $b->where('status', (int) $request->status)
            )
            ->when(
                $request->filled('department_id'),
                fn (Builder $b) => $b->where('department_id', (int) $request->department_id)
            );
    }
}
