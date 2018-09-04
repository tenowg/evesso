<?php

namespace EveSSO;

use EveSSO\EsiModel;

class CorporationPublic extends EsiModel
{
    protected $primaryKey = 'corporation_id';
    public $incrementing = false;

    protected $fillable = [
        'corporation_id',
        'alliance_id',
        'ceo_id',
        'creater_id',
        'date_founded',
        'description',
        'faction_id',
        'home_station_id',
        'member_count',
        'name',
        'shares',
        'tax_rate',
        'ticker',
        'url'
    ];
}