<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * App\CorporationContract
 *
 * @mixin \Eloquent
 * @property int $corporation_id
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereAcceptorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereAssigneeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereBuyout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereCollateral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereDateAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereDateCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereDateExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereDateIssued($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereDaysToComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereEndLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereForCorporation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereIssuerCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereIssuerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereStartLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereVolume($value)
 * @property string $etag
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationContract whereEtag($value)
 */
class CorporationContract extends EsiModel
{
    protected $fillable = [
        'corporation_id',
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
    protected $table = 'corporation_contracts';
}
