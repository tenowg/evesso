<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CharacterRoles
 *
 * @property int $character_id
 * @property array $roles
 * @property array $roles_at_base
 * @property array $roles_at_hq
 * @property array $roles_at_other
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \EveSSO\CharacterPublic $character
 * @property-read \EveSSO\EveSSO $sso
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterRoles whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterRoles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterRoles whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterRoles whereRolesAtBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterRoles whereRolesAtHq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterRoles whereRolesAtOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CharacterRoles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CharacterRoles extends EsiModel
{
    protected $fillable = [
        'character_id',
        'roles',
        'roles_at_base',
        'roles_at_hq',
        'roles_at_other'
    ];

    protected $casts = [
        'roles' => 'array',
        'roles_at_base' => 'array',
        'roles_at_hq' => 'array',
        'roles_at_other' => 'array'
    ];

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'character_id');
    }

    public function character() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }
}
