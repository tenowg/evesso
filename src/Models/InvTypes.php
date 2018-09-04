<?php

namespace App;

use EveSSO\EsiModel;

class InvTypes extends EsiModel
{
    protected $primaryKey = 'type_id';
    public $incrementing = false;
    protected $table = 'inv_types';

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
