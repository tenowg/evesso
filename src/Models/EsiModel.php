<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;

/**
 * EveSSO\EsiModel
 *
 * @mixin \Eloquent
 */
class EsiModel extends Model
{
    public function __construct(array $attributes = []) {
        $this->connection = config('eve-sso.database');
        parent::__construct($attributes);
    }
}