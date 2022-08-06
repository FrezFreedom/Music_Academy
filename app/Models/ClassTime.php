<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClassTime
 *
 * @property int $id
 * @property int $course_id
 * @property string $description
 * @property string $start_time
 * @property string $end_time
 * @property-read \App\Models\Course|null $course
 * @method static \Database\Factories\ClassTimeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTime query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTime whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTime whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTime whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTime whereStartTime($value)
 * @mixin \Eloquent
 */
class ClassTime extends Model
{
    use HasFactory;

    public $timestamps = false;

//    protected $casts = [
//        'start_time' => 'datetime',
//        'end_time' => 'datetime',
//    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
