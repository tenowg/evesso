<?php

namespace EveSSO;

use EveSSO\EsiModel;

/**
 * EveSSO\CorporationPublic
 *
 * @property int $corporation_id
 * @property int|null $alliance_id
 * @property int $ceo_id
 * @property int $creator_id
 * @property string|null $date_founded
 * @property string|null $description
 * @property int|null $faction_id
 * @property int|null $home_station_id
 * @property int $member_count
 * @property string $name
 * @property int|null $shares
 * @property float $tax_rate
 * @property string $ticker
 * @property string|null $url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \EveSSO\CharacterPublic $ceo
 * @property-read \EveSSO\CharacterPublic $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\CharacterPublic[] $members
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereAllianceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereCeoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereDateFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereFactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereHomeStationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereMemberCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereShares($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereTaxRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereTicker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\CorporationPublic whereUrl($value)
 * @mixin \Eloquent
 * @property-read \EveSSO\AlliancePublic $alliance
 * @property-read \Illuminate\Database\Eloquent\Collection|\EveSSO\CorporationIndustryJobs[] $industryJobs
 */
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

    public function members() {
        return $this->hasMany('EveSSO\CharacterPublic', 'corporation_id', 'corporation_id');
    }

    public function ceo() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'ceo_id');
    }

    public function creator() {
        return $this->hasOne('EveSSO\CharacterPublic', 'character_id', 'creator_id');
    }

    public function industryJobs() {
        return $this->hasMany('EveSSO\CorporationIndustryJobs', 'corporation_id', 'corporation_id');
    }

    public function alliance() {
        return $this->hasOne('EveSSO\AlliancePublic', 'alliance_id', 'alliance_id');
    }
}