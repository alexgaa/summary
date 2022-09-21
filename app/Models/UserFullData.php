<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFullData extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @param $value
     * @return void
     */
    public function setMainSkillsAttribute($value)
    {
        if($value) {
            $this->attributes['mainSkills'] = json_encode(explode("\r\n",$value));
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getMainSkillsAttribute($value)
    {
        if ($value) {
            return json_decode($value);
        }
        return $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setEducationAttribute($value)
    {
        if($value) {
            $this->attributes['education'] = json_encode(explode("\r\n",$value));
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getEducationAttribute($value)
    {
        if ($value) {
            return json_decode($value);
        }
        return $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setWorkLocationAttribute($value)
    {
        if($value) {
            $this->attributes['workLocation'] = json_encode(explode("\r\n",$value));
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getWorkLocationAttribute($value)
    {
        if ($value) {
            return json_decode($value);
        }
        return $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setJobTitleAttribute($value)
    {
        if($value) {
            $this->attributes['jobTitle'] = json_encode(explode("\r\n",$value));
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getJobTitleAttribute($value)
    {
        if ($value) {
            return json_decode($value);
        }
        return $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setAchievementsAttribute($value)
    {
        if($value) {
            $this->attributes['achievements'] = json_encode(explode("\r\n",$value));
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getAchievementsAttribute($value)
    {
        if ($value) {
            return json_decode($value);
        }
        return $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setPersonalQualitiesAttribute($value)
    {
        if($value) {
            $this->attributes['personalQualities'] = json_encode(explode("\r\n",$value));
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getPersonalQualitiesAttribute($value)
    {
        if ($value) {
            return json_decode($value);
        }
        return $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setOtherAttribute($value)
    {
        if($value) {
            $this->attributes['other'] = json_encode(explode("\r\n",$value));
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getOtherAttribute($value)
    {
        if ($value) {
            return json_decode($value);
        }
        return $value;
    }
}
