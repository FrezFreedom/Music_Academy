<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
