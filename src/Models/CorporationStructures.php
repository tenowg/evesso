<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * App\CorporationStructures
 *
 * @property int $corporation_id
 * @property string|null $fuel_expires
 * @property string|null $next_reinforce_apply
 * @property int|null $next_reinforce_hour
 * @property int|null $next_reinforce_weekday
 * @property int $profile_id
 * @property int $reinforce_hour
 * @property int $reinforce_weekday
 * @property array $services
 * @property string $state
 * @property string|null $state_timer_end
 * @property string|null $state_timer_start
 * @property int $structure_id
 * @property int $system_id
 * @property int $type_id
 * @property string|null $unanchors_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \EveSSO\CorporationPublic $corp
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereFuelExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereNextReinforceApply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereNextReinforceHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereNextReinforceWeekday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereReinforceHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereReinforceWeekday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereStateTimerEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereStateTimerStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereUnanchorsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationStructures whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CorporationStructures extends EsiModel
{
    protected $primaryKey = 'structure_id';
    public $incrementing = false;
    protected $fillable = [
        'corporation_id',
        'fuel_expires',
        'next_reinforce_apply',
        'next_reinforce_hour',
        'next_reinforce_weekday',
        'profile_id',
        'reinforce_hour',
        'reinforce_weekday',
        'services',
        'state',
        'state_timer_end',
        'state_timer_start',
        'structure_id',
        'system_id',
        'type_id',
        'unanchors_at'
    ];

    protected $casts = [
        'services' => 'array'
    ];

    public function corp() {
        return $this->hasOne('EveSSO\CorporationPublic', 'corporation_id', 'corporation_id');
    }
}
