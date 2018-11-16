<?php

namespace App;

use EveSSO\EsiModel;

/**
 * App\CorporationIndustryJobs
 *
 * @property-read \EveSSO\CorporationPublic $corporation
 * @property-read \EveSSO\CharacterPublic $installer
 * @property-read \EveSSO\EveSSO $installer_sso
 * @mixin \Eloquent
 * @property int $activity_id
 * @property int $corporation_id
 * @property int $blueprint_id
 * @property int $blueprint_location_id
 * @property int $blueprint_type_id
 * @property int|null $completed_character_id
 * @property string|null $completed_date
 * @property float|null $cost
 * @property int $duration
 * @property string $end_date
 * @property int $facility_id
 * @property int $installer_id
 * @property int $job_id
 * @property int|null $licensed_runs
 * @property int $output_location_id
 * @property string|null $pause_date
 * @property float|null $probability
 * @property int|null $product_type_id
 * @property int $runs
 * @property string $start_date
 * @property int $station_id
 * @property string $status
 * @property int|null $successful_runs
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereBlueprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereBlueprintLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereBlueprintTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereCompletedCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereCompletedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereInstallerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereLicensedRuns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereOutputLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs wherePauseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereProductTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereRuns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereStationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereSuccessfulRuns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CorporationIndustryJobs whereUpdatedAt($value)
 */
class CorporationIndustryJobs extends EsiModel
{
    public $incrementing = false;
    protected $primaryKey = 'job_id';

    protected $fillable = [
        'corporation_id',
        'activity_id',
        'blueprint_id',
        'blueprint_location_id',
        'blueprint_type_id',
        'completed_character_id',
        'completed_date',
        'cost',
        'duraction',
        'end_date',
        'facility_id',
        'installer_id',
        'job_id',
        'licensed_runs',
        'output_location_id',
        'pause_date',
        'probability',
        'product_type_id',
        'runs',
        'start_date',
        'station_id',
        'status',
        'successful_runs'
    ];

    public function installer() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'isntaller_id');
    }

    public function installer_sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'installer_id');
    }

    public function corporation() {
        return $this->hasOne('EveSSO\CorporationPublic', 'corporation_id', 'corporation_id');
    }
}
