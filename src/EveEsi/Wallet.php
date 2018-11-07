<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;

use EveEsi\Scopes;
use App\CharacterBalance;

class Wallet extends BaseEsi {

    /**
     * @var Esi
     */
    private $esi;

    public function __construct(Esi $e) {
        $this->esi = $e;
        parent::__construct();
    }

    public function getCharacterBalance(EveSSO $sso) {
        $uri = sprintf('characters/%s/wallet/', $character_id);

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_balance-' . $sso->character_id]);
        $return = $this->esi->callEsiAuth($access_token, $uri, [], Scopes::READ_CHARACTER_WALLET, $expires);

        if (!$this->commit_data) {
            return $return;
        }

        $balance = CharacterBalance::updateOrCreate(['character_id' => $sso->character_id], ['balance' => $return]);

        return $balance;
    }

    public function getCharacterJournal($character_id, $access_token, $page = 1) {
        $uri = sprintf('characters/%s/wallet/journal/', $character_id);
        $params = [
            'page' => $page
        ];

        return $this->esi->callEsiAuth($access_token, $uri, $params, Scopes::READ_CHARACTER_WALLET);
    }
}