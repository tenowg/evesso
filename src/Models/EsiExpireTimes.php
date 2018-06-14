<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;
use EveSSO\EsiModel;
use Carbon\Carbon;

/**
 * EveSSO\EsiExpireTimes
 *
 * @property string $esi_name
 * @property int $expires
 * @property string $etag
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EsiExpireTimes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EsiExpireTimes whereEsiName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EsiExpireTimes whereEtag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EsiExpireTimes whereExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EveSSO\EsiExpireTimes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EsiExpireTimes extends EsiModel
{
    protected $primaryKey = 'esi_name';
    public $incrementing = false;
    protected $table = 'esi_expire_times';

    protected $fillable = [
        'esi_name',
        'expires',
        'etag'
    ];

    public function expired() {
        $expires_at = $this->updated_at->copy()->addSeconds($this->expires);
        return $expires_at->lt(new Carbon());
    }
}
