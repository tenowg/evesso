<?php

namespace EveSSO;

use EveSSO\EsiModel;
use Carbon\Carbon;

/**
 * EveSSO\CharacterPublic
 *
 * @property int $character_id
 * @property int|null $alliance_id
 * @property int|null $ancestry_id
 * @property string $birthday
 * @property int $bloodline_id
 * @property int $corporation_id
 * @property string|null $description
 * @property int|null $faction_id
 * @property string $gender
 * @property string $name
 * @property int $race_id
 * @property float $security_status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereAllianceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereAncestryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereBloodlineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereFactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereRaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereSecurityStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $titles
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterPublic whereTitles($value)
 * @property-read \EveSSO\CorporationPublic $corp
 * @property-read \EveSSO\CharacterRoles $roles
 * @property-read \EveSSO\EveSSO $sso
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\CharacterStats[] $stats
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\CharacterIndustryJobs[] $jobs
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\CharacterNotifications[] $notifications
 */
class CharacterPublic extends EsiModel
{
    protected $fillable = [
        'character_id',
        'alliance_id',
        'ancestry_id',
        'birthday',
        'bloodline_id',
        'corporation_id',
        'description',
        'faction_id',
        'gender',
        'name',
        'race_id',
        'security_status',
        'titles'
    ];

    protected $casts = [
        'titles' => 'array'
    ];

    protected $primaryKey = 'character_id';
    public $incrementing = false;
    protected $table = 'character_public';

    /**
     * @return boolean
     */
    public function expired() {
        $expires_at = $this->updated_at->copy()->addSeconds(3600);
        return $expires_at->lt(new Carbon());
    }

    public function corp() {
        return $this->hasOne('EveSSO\CorporationPublic', 'corporation_id', 'corporation_id');
    }

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'character_id');
    }

    public function stats() {
        return $this->hasMany('EveSSO\CharacterStats', 'character_id', 'character_id');
    }

    public function roles() {
        return $this->hasOne('EveSSO\CharacterRoles', 'character_id', 'character_id');
    }

    public function jobs() {
        return $this->hasMany('EveSSO\CharacterIndustryJobs', 'installer_id', 'character_id');
    }

    public function notifications() {
        return $this->hasMany('EveSSO\CharacterNotifications', 'character_id', 'character_id');
    }
}
