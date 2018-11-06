<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\Structure
 *
 * @property int $structure_id
 * @property string $name
 * @property int $owner_id
 * @property array $position
 * @property int $solar_system_id
 * @property int|null $type_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\Structure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\Structure whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\Structure whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\Structure wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\Structure whereSolarSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\Structure whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\Structure whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\Structure whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \EveSSO\CorporationPublic $owner
 */
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

    public function owner() {
        return $this->hasOne('EveSSO\CorporationPublic', 'corporation_id', 'owner_id');
    }
}
