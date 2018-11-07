<?php

namespace App;

use EveSSO\EsiModel;

class CharacterBalance extends EsiModel
{
    protected $table = 'character_balances';
    public $incrementing = false;
    protected $fillable = [
        'character_id',
        'balance'
    ];
}
