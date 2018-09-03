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

    public function getPersonalContracts(EveSSO $sso) {
        if (!$this->hasScope($sso, Scopes::READ_PERSONAL_CONTRACTS)) {
            throw new InvalidScopeException();
        }

        $uri = sprintf('characters/%s/contracts/', $sso->character_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, []);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_personal_contracts-' . $sso->character_id]);

        if (!$expires->expired()) {
            return PersonalContract::whereCharacterId($sso->character_id)->get()->toArray();
        }

        $return = $this->esi->callEsiAuth($sso, $uri, [], $expires);
        if (!$return) {
            return PersonalContract::whereCharacterId($sso->character_id)->get()->toArray();
        }

        $contracts = array();
        foreach($return as $contract) {
            $contract['character_id'] = $sso->character_id;
            if (array_key_exists('date_accepted', $contract)) {
                $contract['date_accepted'] = new Carbon($contract['date_accepted']);
            }
            if (array_key_exists('date_completed', $contract)) {
                $contract['date_completed'] = new Carbon($contract['date_completed']);
            }
            $contract['date_expired'] = new Carbon($contract['date_expired']);
            $contract['date_issued'] = new Carbon($contract['date_issued']);
            array_push($contracts, PersonalContract::updateOrCreate(['contract_id' => $contract['contract_id']], $contract));
        }
        return $contracts;
    }

    /**
     * requires scope: esi-contracts.read_corporation_contracts.v1
     * @return array
     */
    public function getPersonalContractItems(EvSSO $sso, number $contract_id) {
        if (!$this->hasScope($sso, Scopes::READ_PERSONAL_CONTRACTS)) {
            throw new InvalidScopeException();
        }
        
        $uri = sprintf('characters/%s/contracts/%s/items/', $sso->character_id, $contract_id);
        return $this->esi->callEsiAuth($sso, $uri, []);
    }

    /**
     * requires scope: esi-contracts.read_corporation_contracts.v1
     * @return array
     */
    public function getCorporationContracts(EveSSO $sso) {
        if (!$this->hasScope($sso, Scopes::READ_CORP_CONTRACTS)) {
            throw new InvalidScopeException();
        }

        $public = $this->char_esi->getCharacterPublic($sso);
        if ($public instanceof CharacterPublic) {
            $uri = sprintf('corporations/%s/contracts/', $public->corporation_id);
            
            if (!$this->commit_data) {
                return $this->esi->callEsiAuth($sso, $uri, []);
            }
            
            $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporation_contracts-' . $public->corporation_id]);
            if ($expires->expired()) {
                $return = $this->esi->callEsiAuth($sso, $uri, [], $expires);
                if (!$return) {
                    return CorporationContract::whereCorporationId($public->corporation_id)->get()->toArray();
                }
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
            } else {
                return CorporationContract::whereCorporationId($public->corporation_id)->get()->toArray();
            }
        }

        throw new Exception('Invalid/No Character Found');
    }

    /**
     * requires scope: esi-contracts.read_corporation_contracts.v1
     * @return array
     */
    public function getCorporationContractItems(EvSSO $sso, number $contract_id) {
        if ($this->hasScope($sso, 'esi-contracts.read_corporation_contracts.v1')) {
            throw new InvalidScopeException();
        }
            
        $items = $this->char_esi->getCharacterPublic($sso);
        if ($public instanceof CharacterPublic) {
            $uri = sprintf('corporations/%s/contracts/%s/items/', $public->corporation_id, $contract_id);
            return $this->esi->callEsiAuth($sso, $uri, []);
        }

        throw new Exception('Invalid Character Found or No Character Found');
    }
}
