<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;
use EveSSO\CharacterPublic;
use Carbon\Carbon;

use EveEsi\Scopes;

class Character extends BaseEsi {
    /**
     * @var Esi
     */
    private $esi;

    /**
     * @var boolean
     */
    // private $commit_data;

    public function __construct(Esi $e) {
        $this->esi = $e;
        parent::__construct();
    }

    /**
     * requires scope: esi-characters.read_titles.v1
     */
    public function getTitles(EveSSO $sso) {
        if ($this->hasScope($sso, Scopes::READ_CHARACTER_TITLES)) {
            $public = $this->getCharacterPublic($sso);
            $uri = sprintf('characters/%s/titles/', $sso->character_id);
            if ($this->commit_data) {
                $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_titles-' . $sso->character_id]);
                if ($expires->expired()) {
                    $return = $this->esi->callEsiAuth($sso, $uri, [], $expires);
                    if (!$return) {
                        return $public->titles;
                    } else {
                        $public->titles = $return;
                        $public->save();
                        return $public->titles;
                    }
                }
            }
            return $this->esi->callEsiAuth($sso, $uri, []);
        }

        return [];
    }

    /**
     * @return CharacterPublic 
     */
    public function getCharacterPublic($character_id) {
        if ($character_id instanceof EveSSO) {
            $character_id = $character_id->character_id;
        }
        
        $uri = sprintf('characters/%s/', $character_id);

        $return = $this->esi->callEsi($uri, []);
        if ($this->commit_data) {
            // First get the existing if it exists
            $character = CharacterPublic::find($character_id);
            if ($character != null) {
                if (!$character->expired()) {
                    return $character;
                }
                // update the entry
                $character->alliance_id = array_key_exists('alliance_id', $return) ? $return['alliance_id'] : null; 
                $character->corporation_id = $return['corporation_id'];
                $character->description = array_key_exists('description', $return) ? $return['description'] : null;
                $character->faction_id = array_key_exists('faction_id', $return) ? $return['faction_id'] : null;
                $character->security_status = array_key_exists('security_status', $return) ? $return['security_status'] : null;

                $character->save();
            } else {
                $character = CharacterPublic::create([
                    'character_id' => $character_id,
                    'alliance_id' => array_key_exists('alliance_id', $return) ? $return['alliance_id'] : null,
                    'ancestry_id' => array_key_exists('ancestry_id', $return) ? $return['ancestry_id'] : null,
                    'birthday' => new Carbon($return['birthday']),
                    'bloodline_id' => $return['bloodline_id'],
                    'corporation_id' => $return['corporation_id'],
                    'description' => array_key_exists('description', $return) ? $return['description'] : null,
                    'faction_id' => array_key_exists('faction_id', $return) ? $return['faction_id'] : null,
                    'gender' => $return['gender'],
                    'name' => $return['name'],
                    'race_id' => $return['race_id'],
                    'security_status' => array_key_exists('security_status', $return) ? $return['security_status'] : null
                ]);
            }
            return $character;
        }
        return $return;
    }
}