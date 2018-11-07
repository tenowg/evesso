<?php

namespace App;

use EveSSO\EsiModel;

/**
 * App\CharacterIndustryJobs
 *
 * @mixin \Eloquent
 * @property int $activity_id
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereBlueprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereBlueprintLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereBlueprintTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereCompletedCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereCompletedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereInstallerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereLicensedRuns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereOutputLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs wherePauseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereProductTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereRuns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereStationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereSuccessfulRuns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CharacterIndustryJobs whereUpdatedAt($value)
 */
class CharacterIndustryJobs extends EsiModel
{
    public $incrementing = false;
    protected $primaryKey = 'job_id';

    protected $fillable = [
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
}
