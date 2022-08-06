<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MaestroAbility
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $ability_id
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\MaestroAbilityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MaestroAbility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaestroAbility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaestroAbility query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaestroAbility whereAbilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaestroAbility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaestroAbility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaestroAbility whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaestroAbility whereUserId($value)
 * @mixin \Eloquent
 */
class MaestroAbility extends Model
{
    use HasFactory;
    protected $table = 'maestro_abilities';
    protected $fillable = ['maestro_id', 'ability_id'];
    public static $abilities_list = ['violin', 'guitar', 'setar', 'piano'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
