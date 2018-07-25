<?php

namespace EveSSO;

use EveSSO\EsiModel;

class CharacterAssets extends EsiModel
{
    protected $table = 'character_assets';
    public $incrementing = true;

    protected $fillable = [
        'character_id',
        'is_blueprint_copy',
        'is_singleton',
        'item_id',
        'location_flag',
        'location_id',
        'location_type',
        'quantity',
        'type_id',
        'item_name'
    ];

    public function characterPublic() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'character_id');
    }
}
