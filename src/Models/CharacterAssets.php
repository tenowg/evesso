<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CharacterAssets
 *
 * @property int $id
 * @property int $character_id
 * @property int|null $is_blueprint_copy
 * @property int $is_singleton
 * @property int $item_id
 * @property string $location_flag
 * @property int $location_id
 * @property string $location_type
 * @property int $quantity
 * @property int $type_id
 * @property string|null $item_name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \EveSSO\CharacterPublic $characterPublic
 * @property-read \EveSSO\EveSSO $sso
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereIsBlueprintCopy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereIsSingleton($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereItemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereLocationFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereLocationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterAssets whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CharacterAssets extends EsiModel
{
    protected $table = 'character_assets';
    public $incrementing = true;

    protected $fillable = [
        'character_id',
        'is_blueprint_copy',
        'is_singleton',
        'item_id',
        'location_flag',
        'location_id',
        'location_type',
        'quantity',
        'type_id',
        'item_name'
    ];

    public function characterPublic() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'character_id');
    }
}
