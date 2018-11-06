<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;

use EveEsi\Scopes;

class Wallet extends BaseEsi {

    /**
     * @var Esi
     */
    private $esi;

    public function __construct(Esi $e) {
        $this->esi = $e;
        parent::__construct();
    }

    public function getCharacterBalance($character_id, $access_token) {
        $uri = sprintf('characters/%s/wallet/', $character_id);

        return $this->esi->callEsiAuth($access_token, $uri, [], Scopes::READ_CHARACTER_WALLET);
    }

    public function getCharacterJournal($character_id, $access_token, $page = 1) {
        $uri = sprintf('characters/%s/wallet/journal/', $character_id);
        $params = [
            'page' => $page
        ];

        return $this->esi->callEsiAuth($access_token, $uri, $params, Scopes::READ_CHARACTER_WALLET);
    }
}