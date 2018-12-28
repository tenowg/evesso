<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterFleet extends Model
{
    protected $primaryKey = 'character_id';
    public $incrementing = false;
    protected $fillable = [
        'character_id',
        'fleet_id',
        'role',
        'squad_id',
        'wing_id'
    ];
}
