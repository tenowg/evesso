<?php

namespace EveSSO;

use EveSSO\EsiModel;

class Structure extends EsiModel
{
    protected $fillable = [
        'structure_id',
        'name',
        'owner_id',
        'position',
        'solar_system_id',
        'type_id'
    ];

    protected $primaryKey = 'structure_id';
    public $incrementing = false;

    protected $casts = [
        'position' => 'array'
    ];
}
