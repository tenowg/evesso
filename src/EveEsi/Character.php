<?php

namespace EveEsi;

use EveEsi\Esi;
use EveSSO\EveSSO;

class Character {
    private $esi;

    public function __construct(Esi $e) {
        $this->esi = $e;
    }

    public function getTitles(EveSSO $sso) {        
        $uri = sprintf('characters/%s/titles/', $sso->character_id);
        return $this->esi->callEsiAuth($sso, $uri, []);
    }

    public function getCharacterPublic($character_id) {
        $uri = sprintf('characters/%s/', $character_id);
        return $this->esi->callEsi($uri, []);
    }
}