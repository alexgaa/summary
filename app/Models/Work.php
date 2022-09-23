<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * @param array $usersId
     * @return Collection
     */
    public function selectExperienceWithWork(array $usersId = []): Collection
    {
        if($usersId !== []) {
            $works = DB::table('experiences')
                ->select(
                    'experiences.id',
                    'experience_work.priority',
                    'works.name as work_name'
                )
                ->join(
                    'experience_work',
                    'experience_work.experience_id',
                    '=',
                    'experiences.id'
                )
                ->join(
                    'works',
                    'experience_work.work_id',
                    '=',
                    'works.id'
                )
                ->orderBy('experience_work.priority')
                ->get();
        } else {
            $works = DB::table('experiences')
                ->select(
                    'experiences.id',
                    'experience_work.priority',
                    'works.name as work_name'
                )
                ->join(
                    'experience_work',
                    'experience_work.experience_id',
                    '=',
                    'experiences.id'
                )
                ->join(
                    'works',
                    'experience_work.work_id',
                    '=',
                    'works.id'
                )
                ->whereIn('experiences.user_id', $usersId)
                ->orderBy('experience_work.priority')
                ->get();
        }
        return $works;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
