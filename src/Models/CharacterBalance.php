<?php

namespace App;

use EveSSO\EsiModel;

/**
 * App\CharacterBalance
 *
 * @property int $character_id
 * @property float $balance
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterBalance whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterBalance whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterBalance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CharacterBalance extends EsiModel
{
    protected $table = 'character_balances';
    protected $primaryKey = 'character_id';
    public $incrementing = false;
    protected $fillable = [
        'character_id',
        'balance'
    ];
}
