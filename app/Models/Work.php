<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Work extends Model
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
    public function selectExperienceWithWork(): Collection
    {
        $works = DB::table('experiences')
            ->select('experiences.id',
                'experience_work.priority',
                'works.name as work_name')
            ->join('experience_work',
                'experience_work.experience_id',
                '=', 'experiences.id')
            ->join('works',
                'experience_work.work_id',
                '=', 'works.id')
            ->orderBy('experience_work.priority')
            ->get();
        return $works;
    }
}
