<?php

namespace EveSSO;

use EveSSO\EsiModel;

class CorporationAsset extends EsiModel
{
    protected $primaryKey = 'item_id';
    public $incrementing = false;

    protected $fillable = [
        'corporation_id',
        'is_blueprint_copy',
        'is_singleton',
        'item_id',
        'location_flag',
        'location_id',
        'location_type',
        'quantity',
        'type_id'
    ];
}
