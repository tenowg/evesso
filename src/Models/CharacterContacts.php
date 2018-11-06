<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CharacterContacts
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $character_id
 * @property int $contact_id
 * @property string $contact_type
 * @property int|null $is_blocked
 * @property int|null $is_watched
 * @property array $label_ids
 * @property float $standing
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereContactType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereIsWatched($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereLabelIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereStanding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterContacts whereUpdatedAt($value)
 * @property-read \EveSSO\CharacterPublic $character
 */
class CharacterContacts extends EsiModel
{
    protected $table = 'character_contacts';
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

    public function character() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }
}
