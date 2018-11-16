<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * App\CharacterCorporationHistory
 *
 * @property-read \EveSSO\CharacterPublic $character
 * @property-read \EveSSO\CorporationPublic $corporation
 * @property-read \EveSSO\EveSSO $sso
 * @mixin \Eloquent
 * @property int $id
 * @property int $character_id
 * @property int $corporation_id
 * @property int|null $is_deleted
 * @property int $record_id
 * @property string $start_date
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterCorporationHistory whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterCorporationHistory whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterCorporationHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterCorporationHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterCorporationHistory whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterCorporationHistory whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterCorporationHistory whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterCorporationHistory whereUpdatedAt($value)
 */
class CharacterCorporationHistory extends EsiModel
{
    protected $fillable = [
        'character_id',
        'corporation_id',
        'is_deleted',
        'record_id',
        'start_date'
    ];

    public function character() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'character_id');
    }

    public function corporation() {
        return $this->hasOne('EveSSO\CorporationPublic', 'corporation_id', 'corporation_id');
    }
}
