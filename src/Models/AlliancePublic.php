<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\AlliancePublic
 *
 * @property-read \EveSSO\CharacterPublic $creator
 * @property-read \EveSSO\EveSSO $creator_sso
 * @property-read \EveSSO\CorporationPublic $executor
 * @mixin \Eloquent
 * @property int $alliance_id
 * @property int $creator_id
 * @property string $date_founded
 * @property int|null $executor_corporation_id
 * @property int|null $faction_id
 * @property string $name
 * @property string $ticker
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereAllianceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereDateFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereExecutorCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereFactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereTicker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\AlliancePublic whereUpdatedAt($value)
 */
class AlliancePublic extends EsiModel
{
    protected $fillable = [
        'alliance_id',
        'creator_id',
        'date_founded',
        'executor_corporation_id',
        'faction_id',
        'name',
        'ticker'
    ];

    public function executor() {
        return $this->hasOne('EveSSO\CorporationPublic', 'corporation_id', 'executor_corporation_id');
    }

    public function creator() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'creator_id');
    }

    public function creator_sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'creator_id');
    }
}
