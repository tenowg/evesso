<?php

namespace EveSSO;

use EveSSO\EsiModel;

class CharacterNotifications extends EsiModel
{
    public $incrementing = true;

    protected $fillable = [
        'character_id',
        'is_read',
        'notification_id',
        'sender_id',
        'sender_type',
        'text',
        'timestamp',
        'type'
    ];
}
