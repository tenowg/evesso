<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CharacterStats
 *
 * @property int $id
 * @property int $character_id
 * @property \EveSSO\CharacterPublic $character
 * @property array $combat
 * @property array $industry
 * @property string $inventory
 * @property array $isk
 * @property array $market
 * @property array $mining
 * @property array $module
 * @property array $orbital
 * @property array $pve
 * @property array $social
 * @property array $travel
 * @property int $year
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \EveSSO\EveSSO $sso
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereCharacter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereCombat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereInventory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereIsk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereMarket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereMining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereOrbital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats wherePve($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereTravel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterStats whereYear($value)
 * @mixin \Eloquent
 */
class CharacterStats extends EsiModel
{
    protected $fillable = [
        'character_id',
        'character',
        'combat',
        'industry',
        'isk',
        'market',
        'mining',
        'module',
        'orbital',
        'pve',
        'social',
        'travel',
        'year'
    ];

    protected $casts = [
        'character' => 'array',
        'combat' => 'array',
        'industry' => 'array',
        'isk' => 'array',
        'market' => 'array',
        'mining' => 'array',
        'module' => 'array',
        'orbital' => 'array',
        'pve' => 'array',
        'social' => 'array',
        'travel' => 'array'
    ];

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'character_id');
    }

    public function character() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }
}
