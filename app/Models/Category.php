<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    use HasFactory;
    protected $primaryKey='id';

    /**
     * @return HasMany
     */
    public function postType(): HasMany
    {
        return $this->hasMany(PostType::class);
    }
}
