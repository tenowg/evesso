<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;

use EveEsi\Scopes;

class Skills extends BaseEsi {

    /**
     * @var Esi
     */
    private $esi;

    public function __construct(Esi $e) {
        $this->esi = $e;
        parent::__construct();
    }

    public function getCharacterSkills(EveSSO $sso) {
        $uri = sprintf('characters/%s/skills/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_SKILLS);
    }
}