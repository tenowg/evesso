<?php

namespace EveEsi;

use EveEsi\Esi;
use EveSSO\EveSSO;

class Mail {
    private $esi;

    public function __construct(Esi $e) {
        $this->esi = $e;
    }

    public function getCharacterMail(EveSSO $user) {
        $uri = sprintf('characters/%s/mail/', $user->character_id);

        return $this->esi->callEsiAuth($user, $uri, []);
    }
}