<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
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
}
