<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CorporationTitles
 *
 * @property int $id
 * @property int $corporation_id
 * @property array $grantable_roles
 * @property array $grantable_roles_at_base
 * @property array $grantable_roles_at_hq
 * @property array $grantable_roles_at_other
 * @property string $name
 * @property array $roles
 * @property array $roles_at_base
 * @property array $roles_at_hq
 * @property array $roles_at_other
 * @property int $title_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereGrantableRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereGrantableRolesAtBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereGrantableRolesAtHq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereGrantableRolesAtOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereRolesAtBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereRolesAtHq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereRolesAtOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationTitles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CorporationTitles extends EsiModel
{
    protected $fillable = [
        'corporation_id',
        'grantable_roles',
        'grantable_roles_at_base',
        'grantable_roles_at_hq',
        'grantable_roles_at_other',
        'name',
        'roles',
        'roles_at_base',
        'roles_at_hq',
        'roles_at_other',
        'title_id'
    ];

    protected $casts = [
        'grantable_roles' => 'array',
        'grantable_roles_at_base' => 'array',
        'grantable_roles_at_hq' => 'array',
        'grantable_roles_at_other' => 'array',
        'roles' => 'array',
        'roles_at_base' => 'array',
        'roles_at_hq' => 'array',
        'roles_at_other' => 'array'
    ];
}
