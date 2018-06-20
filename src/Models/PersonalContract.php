<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\PersonalContract
 *
 * @mixin \Eloquent
 * @property int $character_id
 * @property int $acceptor_id
 * @property int $assignee_id
 * @property string $availability
 * @property float|null $buyout
 * @property float|null $collateral
 * @property int $contract_id
 * @property string|null $date_accepted
 * @property string|null $date_completed
 * @property string $date_expired
 * @property string $date_issued
 * @property int|null $days_to_complete
 * @property int|null $end_location_id
 * @property int $for_corporation
 * @property int $issuer_corporation_id
 * @property int $issuer_id
 * @property float|null $price
 * @property float|null $reward
 * @property int|null $start_location_id
 * @property string $status
 * @property string|null $title
 * @property string $type
 * @property float|null $volume
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereAcceptorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereAssigneeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereBuyout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereCollateral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereDateAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereDateCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereDateExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereDateIssued($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereDaysToComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereEndLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereForCorporation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereIssuerCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereIssuerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereStartLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\PersonalContract whereVolume($value)
 */
class PersonalContract extends EsiModel
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
