<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EveSSO;

class Mail extends BaseEsi {
    private $esi;

    public function __construct(Esi $e) {
        parent::__construct();
        $this->esi = $e;
    }

    public function getCharacterMail(EveSSO $user) {
        $uri = sprintf('characters/%s/mail/', $user->character_id);

        return $this->esi->callEsiAuth($user, $uri, []);
    }
}