<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;
use EveSSO\EsiModel;

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
        'security_status'
    ];

    protected $primaryKey = 'character_id';
    public $incrementing = false;
    protected $table = 'character_public';
}
