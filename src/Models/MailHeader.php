<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\MailHeader
 *
 * @property int $character_id
 * @property int $from
 * @property int $is_read
 * @property array $labels
 * @property int $mail_id
 * @property array $recipients
 * @property string $subject
 * @property string $timestamp
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereLabels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereMailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\MailHeader whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
