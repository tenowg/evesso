<?php

namespace App;

use EveSSO\EsiModel;

class InvTypes extends EsiModel
{
    protected $primaryKey = 'type_id';
    public $incrementing = false;
    protected $table = 'inv_types';
    protected $casts = [
        'dogma_attributes' => 'array',
        'domga_effects' => 'array'
    ];

    protected $fillable = [
        'capacity',
        'description',
        'dogma_attributes',
        'dogma_effects',
        'graphic_id',
        'group_id',
        'icon_id',
        'market_group_id',
        'mass',
        'name',
        'packaged_volume',
        'portion_size',
        'published',
        'radius',
        'type_id',
        'volume'
    ];
}
