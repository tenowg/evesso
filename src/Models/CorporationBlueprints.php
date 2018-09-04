<?php

namespace EveSSO;

use EveSSO\EsiModel;

class CorporationBlueprints extends EsiModel
{
    protected $table = "corporation_blueprints";
    protected $primaryKey = 'item_id';
    public $incrementing = false;

    protected $fillable = [
        'corporation_id',
        'item_id',
        'location_flag',
        'location_id',
        'material_efficiency',
        'quantity',
        'runs',
        'time_efficiency',
        'type_id'
    ];
}