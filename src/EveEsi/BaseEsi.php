<?php
namespace EveEsi;

use EveSSO\EveSSO;

class BaseEsi {
    /**
    * @var boolean
    */
    protected $commit_data;

    public function __construct()
    {
        $this->commit_data = config('eve-sso.commit_data');
    }
}