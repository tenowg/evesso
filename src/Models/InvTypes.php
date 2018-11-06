<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\InvTypes
 *
 * @property int $type_id
 * @property float|null $capacity
 * @property string $description
 * @property array $dogma_attributes
 * @property string $dogma_affects
 * @property int|null $graphic_id
 * @property int $group_id
 * @property int|null $icon_id
 * @property int|null $market_group_id
 * @property float|null $mass
 * @property string $name
 * @property float|null $packaged_volume
 * @property int|null $portion_size
 * @property int $published
 * @property float|null $radius
 * @property float|null $volume
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereDogmaAffects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereDogmaAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereGraphicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereIconId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereMarketGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereMass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes wherePackagedVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes wherePortionSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereRadius($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\InvTypes whereVolume($value)
 * @mixin \Eloquent
 */
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
