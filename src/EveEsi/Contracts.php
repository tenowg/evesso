<?php

namespace EveEsi;

use Carbon\Carbon;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveEsi\Character;
use EveSSO\EveSSO;
use EveSSO\CharacterPublic;
use EveSSO\CorporationContract;
use EveSSO\EsiExpireTimes;

class Contracts extends BaseEsi {
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

    /**
     * requires scope: esi-contracts.read_corporation_contracts.v1
     * @return array
     */
    public function getCorporationContracts(EveSSO $sso) {
        if ($this->hasScope($sso, 'esi-contracts.read_corporation_contracts.v1')) {
            $public = $this->char_esi->getCharacterPublic($sso);
            if ($public instanceof CharacterPublic) {
                $uri = sprintf('corporations/%s/contracts/', $public->corporation_id);
                
                if ($this->commit_data) {
                    $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporation_contracts-' . $public->corporation_id]);
                    if ($expires->expired()) {
                        $return = $this->esi->callEsiAuth($sso, $uri, [], $expires);
                        if (!$return) {
                            return CorporationContract::whereCorporationId($public->corporation_id)->get()->toArray();
                        } else {
                            $contracts = array();
                            foreach($return as $contract) {
                                $contract['corporation_id'] = $public->corporation_id;
                                if (array_key_exists('date_accepted', $contract)) {
                                    $contract['date_accepted'] = new Carbon($contract['date_accepted']);
                                }
                                if (array_key_exists('date_completed', $contract)) {
                                    $contract['date_completed'] = new Carbon($contract['date_completed']);
                                }
                                $contract['date_expired'] = new Carbon($contract['date_expired']);
                                $contract['date_issued'] = new Carbon($contract['date_issued']);
                                array_push($contracts, CorporationContract::updateOrCreate(['contract_id' => $contract['contract_id']], $contract));
                            }
                            return $contracts;
                        }
                    } else {
                        return CorporationContract::whereCorporationId($public->corporation_id)->get()->toArray();
                    }
                } else {
                    return $this->esi->callEsiAuth($sso, $uri, []);
                }
            }
        }
        return [];
    }

    /**
     * requires scope: esi-contracts.read_corporation_contracts.v1
     * @return array
     */
    public function getCorporationContractItems(EvSSO $sso, number $contract_id) {
        if ($this->hasScope($sso, 'esi-contracts.read_corporation_contracts.v1')) {
            $items = $this->char_esi->getCharacterPublic($sso);
            if ($public instanceof CharacterPublic) {
                $uri = sprintf('corporations/%s/contracts/%s/items/', $public->corporation_id, $contract_id);
                return $this->esi->callEsiAuth($sso, $uri, []);
            }
        }
        return [];
    }
}
