<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Course
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $maestro_id
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CourseStudent[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClassTime[] $times
 * @property-read int|null $times_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\CourseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereMaestroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereStatus($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function maestro(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseStudent::class);
    }

    public function times(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClassTime::class);
    }
}
