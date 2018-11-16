<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CharacterCorporationHistory
 *
 * @property-read \EveSSO\CharacterPublic $character
 * @property-read \EveSSO\CorporationPublic $corporation
 * @property-read \EveSSO\EveSSO $sso
 * @mixin \Eloquent
 */
class CharacterCorporationHistory extends Model
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
