<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;
use EveSSO\EsiModel;
use Carbon\Carbon;

class EveSSO extends EsiModel
{
    protected $table = 'eve_ssos';
    protected $primaryKey = 'character_id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'access_token', 
        'refresh_token',
        'expires',
        'character_id',
        'character_owner_hash',
    ];

    public function expired() {
        $updated = new Carbon($this->updated_at);
        $expires_at = $updated->copy()->addSeconds($this->expires - 10);
        return $expires_at->lt(new Carbon());
    }

    public function characterPublic() {
        return $this->hasMany('EveSSO\CharacterPublic', 'character_id', 'character_id');
    }
}
