<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaestroAbility extends Model
{
    use HasFactory;
    protected $table = 'maestro_abilities';
    protected $fillable = ['maestro_id', 'ability'];
    public $timestamps = false;
    public static $abilities_list = ['violin', 'guitar', 'setar', 'piano'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
