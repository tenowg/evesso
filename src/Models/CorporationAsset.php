<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CorporationAsset
 *
 * @property int $corporation_id
 * @property int $item_id
 * @property int|null $is_blueprint_copy
 * @property int $is_singleton
 * @property string $location_flag
 * @property int $location_id
 * @property string $location_type
 * @property int $quantity
 * @property int $type_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereIsBlueprintCopy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereIsSingleton($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereLocationFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereLocationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationAsset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
