<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;

class PersonalContract extends Model
{
    protected $fillable = [
        'character_id',
        'acceptor_id',
        'assignee_id',
        'availability',
        'buyout',
        'collateral',
        'contract_id',
        'date_accepted',
        'date_completed',
        'date_expired',
        'date_issued',
        'days_to_complete',
        'end_location_id',
        'for_corporation',
        'issuer_corporation_id',
        'issuer_id',
        'price',
        'reward',
        'start_location_id',
        'status',
        'title',
        'type',
        'volume'
    ];

    protected $primaryKey = 'contract_id';
    public $incrementing = false;
    protected $table = 'personal_contracts';
}
