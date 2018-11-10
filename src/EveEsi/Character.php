<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;
use EveSSO\CharacterPublic;
use Carbon\Carbon;

use EveEsi\Scopes;
use EveSSO\Exceptions\InvalidScopeException;
use EveSSO\CharacterNotifications;
use EveSSO\CharacterRoles;

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
        //if ($this->hasScope($sso, Scopes::READ_CHARACTER_TITLES)) {
        $public = $this->getCharacterPublic($sso);
        $uri = sprintf('characters/%s/titles/', $sso->character_id);
        if ($this->commit_data) {
            $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_titles-' . $sso->character_id]);
            if ($expires->expired()) {
                $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_TITLES, $expires);
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

    public function getCspa(EveSSO $sso, EveSSO ...$receivers) {
        $receiver_ids = [];
        foreach($receivers as $receiver) {
            array_push($receiver_ids, $receiver->character_id);
        }

        $uri = sprintf("characters/%s/cspa/", $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, [], Scopes::CONTACTS_CHARACTER_READ, null, 'POST', $receiver_ids);
    }

    /**
     * requires: esi-characters.read_notifications.v1
     */
    public function getNotifications(EveSSO $sso) {
        $uri = sprintf('characters/%s/notifications/', $sso->character_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_NOTIFICATIONS);
        }
        
        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_notifications-' . $sso->character_id]);

        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_ASSETS, $expires);
        if (!$return) {
            return CharacterNotifications::whereCharacterId($sso->character_id)->get()->toArray();
        }

        $notifications = [];
        foreach($return as $note) {
            $note['character_id'] = $sso->character_id;
            $note['timestamp'] = new Carbon($note['timestamp']);
            array_push($notifications, CharacterNotifications::updateOrCreate(['notification_id' => $note['notification_id'], 'character_id' => $sso->character_id], $note));
        }
        return $notifications;
    }

     /**
     * requires: esi-characters.read_notifications.v1
     */
    public function getRoles(EveSSO $sso) {
        $uri = sprintf('characters/%s/roles/', $sso->character_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_ROLES);
        }
        
        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_roles-' . $sso->character_id]);

        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_ROLES, $expires);
        if (!$return) {
            return CharacterRoles::whereCharacterId($sso->character_id)->first();
        }

        $return['character_id'] = $sso->character_id;

        return CharacterRoles::updateOrCreate(['character_id' => $sso->character_id], $return);
    }
}