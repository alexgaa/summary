<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class);
    }
}
