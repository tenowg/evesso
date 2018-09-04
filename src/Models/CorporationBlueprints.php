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

    /**
     * Is this blueprint a Copy
     * 
     * @return boolean
     */
    public function getIsCopyAttribute() {
        return ($this->quantity == -2);
    }

    /**
     * Is this blueprint an Original
     * 
     * @return boolean
     */
    public function getIsOriginalAttribute() {
        return ($this->quantity == -1);
    }

    /**
     * Is this blueprint a Stack of Originals
     * 
     * @return boolean
     */
    public function getIsStackAttribute() {
        return ($this->quantity >= 0);
    }

    public function type() {
        return $this->hasOne('EveSSO\InvTypes', 'type_id', 'type_id');
    }
}