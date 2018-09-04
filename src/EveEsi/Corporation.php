<?php

namespace EveEsi;

use Carbon\Carbon;

use Exception;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveEsi\Character;
use EveSSO\EveSSO;
use EveSSO\CharacterPublic;
use EveSSO\CorporationContract;
use EveSSO\PersonalContract;
use EveSSO\EsiExpireTimes;
use EveEsi\Scopes;

use EveSSO\Exceptions\InvalidScopeException;
use EveSSO\CorporationPublic;
use EveSSO\CorporationBlueprints;

class Corporation extends BaseEsi {
    /**
     * @var Esi
     */
    private $esi;

    /**
     * @var Character
     */
    private $char_esi;

    public function __construct(Esi $e, Character $char) {
        parent::__construct();
        $this->esi = $e;
        $this->char_esi = $char;
    }

    public function getCharacterCorporationPublic(EveSSO $sso) {
        $public = $this->char_esi->getCharacterPublic($sso);
        return $this->getCorporationPublic($public->corporation_id);
    }

    public function getCorporationPublic(int $corp_id) {
        $uri = sprintf('corporations/%s/', $corp_id);

        if (!$this->commit_data) {
            return $this->esi->callEsi($uri, []);
        }

        //$corp = CorporationPublic::find($corp_id);
        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporation_public-' . $corp_id]);

        if (!$expires->expired()) {
            return CorporationPublic::whereCorporationId($corp_id)->get();
        }
        
        $return = $this->esi->callEsi($uri, []);

        if (!$return) {
            return CorporationPublic::whereCorporationId($corp_id)->get();
        }

        if (array_key_exists('date_founded', $return)) {
            $return['date_founded'] = new Carbon($return['date_founded']);
        }

        $corp = CorporationPublic::updateOrCreate(['corporation_id' => $corp_id], $return);

        return $corp;
    }

    public function getCorporationBlueprints(EveSSO $sso) {
        $uri = sprintf('corporations/%s/', $sso->characterPublic->corporation_id);

        if (!$this->commit_data) {
            return $this->esi->callEsi($uri, []);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporation_blueprints-' . $corp_id]);

        if (!$expires->expired()) {
            return CorporationBlueprints::whereCorporationId($sso->characterPublic->corporation_id)->get();
        }
        
        $return = $this->esi->callEsiAuth($sso, $uri, [], $expires);

        if (!$return) {
            return CorporationPublic::whereCorporationId($corp_id)->get();
        }

        $blueprints = CorporationPublic::updateOrCreate(['corporation_id' => $corp_id], $return);

        return $blueprints;
    }
}