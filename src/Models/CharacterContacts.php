<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;

class CharacterContacts extends Model
{
    protected $table = 'character_contacts';
    protected $primaryKey = 'contact_id';
    public $incrementing = true;

    protected $fillable = [
        'character_id',
        'contact_id',
        'contact_type',
        'is_blocked',
        'is_watched',
        'label_ids',
        'standings'
    ];

    protected $casts = [
        'label_ids' => 'array'
    ];
}
