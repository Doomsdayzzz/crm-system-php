<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 */
class Department extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title'
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
