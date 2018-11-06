<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CorporationBlueprints
 *
 * @property int $corporation_id
 * @property int $item_id
 * @property string $location_flag
 * @property int $location_id
 * @property int $material_efficiency
 * @property int $quantity
 * @property int $runs
 * @property int $time_efficiency
 * @property int $type_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read bool $is_copy
 * @property-read bool $is_original
 * @property-read bool $is_stack
 * @property-read \EveSSO\InvTypes $type
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereLocationFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereMaterialEfficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereRuns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereTimeEfficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationBlueprints whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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