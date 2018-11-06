<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CharacterNotifications
 *
 * @property int $id
 * @property int $character_id
 * @property int $is_read
 * @property int $notification_id
 * @property int $sender_id
 * @property string $sender_type
 * @property string|null $text
 * @property string $timestamp
 * @property string $type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \EveSSO\CharacterPublic $character
 * @property-read \EveSSO\EveSSO $sso
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereSenderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterNotifications whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function character() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'character_id');
    }
}
