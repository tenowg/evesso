<?php

namespace EveEsi;

use Carbon\Carbon;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveEsi\Character;

use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;
use EveSSO\AlliancePublic;

use EveEsi\Scopes;
use EveSSO\Exceptions\InvalidScopeException;

class Alliance extends BaseEsi {
    /**
     * @var Esi
     */
    private $esi;

    /**
     * @var Character
     */
    private $char_esi;

    public function __construct(Esi $e, Character $char)
    {
        $this->esi = $e;
        $this->char_esi = $char;
        parent::__construct();
    }

    public function getCharacterAlliancePublic(EveSSO $sso) {
        $public = $this->char_esi->getCharacterPublic($sso);
        return $this->getAlliancePublic($public->alliance_id);
    }

    public function getAlliancePublic(int $alliance_id) {
        $uri = sprintf('alliances/%s/', $alliance_id);

        if (!$this->commit_data) {
            return $this->esi->callEsi($uri, []);
        }
        
        $return = $this->esi->callEsi($uri, []);

        if (!$return) {
            return AlliancePublic::whereAllianceId($alliance_id)->get();
        }

        if (array_key_exists('date_founded', $return)) {
            $return['date_founded'] = new Carbon($return['date_founded']);
        }

        $alliance = AlliancePublic::updateOrCreate(['alliance_id' => $alliance_id], $return);

        return $alliance;
    }
}