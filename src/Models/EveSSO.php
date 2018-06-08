<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;
use EveSSO\EsiModel;
use Carbon\Carbon;

/**
 * EveSSO\EveSSO
 *
 * @property string $name
 * @property string $access_token
 * @property string $refresh_token
 * @property int $expires
 * @property int $character_id
 * @property string $character_owner_hash
 * @property array $scopes
 * @property string|null $avatar
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereCharacterOwnerHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EveSSO whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \EveSSO\CharacterPublic $characterPublic
 */
class EveSSO extends EsiModel
{
    protected $table = 'eve_ssos';
    protected $primaryKey = 'character_id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'access_token', 
        'refresh_token',
        'expires',
        'character_id',
        'character_owner_hash',
        'scopes',
        'avatar'
    ];

    protected $casts = [
        'scopes' => 'array'
    ];

    protected $hidden = [
        'access_token',
        'refresh_token',
        'character_owner_hash',
        'expires'
    ];

    public function expired() {
        $updated = new Carbon($this->updated_at);
        $expires_at = $updated->copy()->addSeconds($this->expires - 10);
        return $expires_at->lt(new Carbon());
    }

    public function characterPublic() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }
}
