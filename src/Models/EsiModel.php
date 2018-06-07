<?php

namespace EveSSO;

use Illuminate\Database\Eloquent\Model;

class EsiModel extends Model
{
    public function __construct(array $attributes = []) {
        $this->connection = config('eve-sso.database');
        parent::__construct($attributes);
    }
}