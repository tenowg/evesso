<?php

namespace EveSSO;

use EveSSO\EsiModel;

class CorporationPublic extends EsiModel
{
    protected $table = "corporation_public";
    protected $primaryKey = 'corporation_id';
    public $incrementing = false;

    protected $fillable = [
        'corporation_id',
        'alliance_id',
        'ceo_id',
        'creator_id',
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