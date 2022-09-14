<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Experience extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class)
            ->withPivot('priority')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function works(): BelongsToMany
    {
        return $this->belongsToMany(Work::class)
            ->withPivot('priority')
            ->withTimestamps();
    }
}
