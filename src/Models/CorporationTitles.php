<?php

namespace EveSSO;

use EveSSO\EsiModel;

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
