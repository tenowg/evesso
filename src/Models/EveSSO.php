<?php

namespace EveSSO;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\CharacterContacts[] $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\PersonalContract[] $contracts
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\MailHeader[] $mailheaders
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\CharacterStats[] $stats
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

    public function contacts() {
        return $this->hasMany('EveSSO\CharacterContacts', 'character_id', 'character_id');
    }

    public function contracts() {
        return $this->hasMany('EveSSO\PersonalContract', 'character_id', 'character_id');
    }

    public function mailheaders() {
        return $this->hasMany('EveSSO\MailHeader', 'character_id', 'character_id');
    }

    public function stats() {
        return $this->hasMany('EveSSO\CharacterStats', 'character_id', 'character_id');
    }
}
