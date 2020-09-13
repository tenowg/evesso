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
use App\CharacterFleet;

class Fleets extends BaseEsi {
    /**
     * @var Esi
     */
    private $esi;

    public function __construct(Esi $e)
    {
        $this->esi = $e;
        parent::__construct();
    }

    public function getFleet(EveSSO $sso) {
        $uri = sprintf('characters/%s/fleet', $sso->character_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_FLEET);
        }
        
        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_FLEET);

        if (!$return) {
            return CharacterFleet::whereCharacterId($sso->character_id)->get();
        }

        if (array_key_exists('date_founded', $return)) {
            $return['character_id'] = $sso->character_id;
        }

        $alliance = CharacterFleet::updateOrCreate(['character_id' => $sso->character_id], $return);

        return $alliance;
    }
}