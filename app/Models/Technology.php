<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Technology extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class)->withTimestamps();
    }

    /**
     * @return Collection
     */
    public function selectExperienceWithTechnology(): Collection
    {
        $technologies = DB::table('experiences')
            ->select('experiences.id',
                'experience_technology.priority',
                'technologies.name as technology_name')
            ->join('experience_technology',
                'experience_technology.experience_id',
                '=', 'experiences.id')
            ->join('technologies',
                'experience_technology.technology_id',
                '=', 'technologies.id')
            ->orderBy('experience_technology.priority')
            ->get();
        return $technologies;
    }
}
