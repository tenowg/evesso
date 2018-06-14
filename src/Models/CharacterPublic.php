<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;
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
}
