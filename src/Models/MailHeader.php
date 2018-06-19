<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;
use EveSSO\EsiModel;

class MailHeader extends EsiModel
{
    protected $table = 'mail_headers';
    protected $primaryKey = 'mail_id';
    public $incrementing = false;

    protected $fillable = [
        'character_id',
        'from',
        'is_read',
        'labels',
        'mail_id',
        'recipients',
        'subject',
        'timestamp'
    ];

    protected $casts = [
        'labels' => 'array',
        'recipients' => 'array'
    ];
}
