<?php

namespace EveEsi;

use EveEsi\Esi;
use EveSSO\EveSSO;
use EveSSO\CharacterPublic;
use Carbon\Carbon;

class Character {
    private $esi;
    private $commit_data;
    private $cache = 3600;

    public function __construct(Esi $e) {
        $this->esi = $e;
        $this->commit_data = config('eve-sso.commit_data');
    }

    public function getTitles(EveSSO $sso) {        
        $uri = sprintf('characters/%s/titles/', $sso->character_id);
        return $this->esi->callEsiAuth($sso, $uri, []);
    }

    public function getCharacterPublic($character_id) {
        $uri = sprintf('characters/%s/', $character_id);

        $return = $this->esi->callEsi($uri, []);
        if ($this->commit_data) {
            // First get the existing if it exists
            $character = CharacterPublic::find($character_id);
            if ($character != null) {
                $expires_at = $character->updated_at->copy()->addSeconds($this->cache - 10);
                if ($expires_at->gt(new Carbon())) {
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