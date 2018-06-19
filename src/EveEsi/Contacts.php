<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;
use EveSSO\CharacterPublic;
use Carbon\Carbon;
use EveSSO\CharacterContacts;

use EveEsi\Scopes;

class Contacts extends BaseEsi {
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

    public function getCharacterContacts(EveSSO $sso) {
        if (!$this->hasScope($sso, Scopes::CONTACTS_CHARACTER_READ)) {
            throw new InvalidScopeException();
        }

        $uri = sprintf('characters/%s/contacts/', $sso->character_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, []);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_contacts-' . $sso->character_id]);
        if (!$expires->expired()) {
            return CharacterContacts::whereCharacterId($sso->character_id)->get()->toArray();
        }

        $return = $this->esi->callEsiAuth($sso, $uri, [], $expires);
        if (!$return) {
            return PersonalContract::whereCharacterId($sso->character_id)->get()->toArray();
        }

        $contracts = array();
        foreach($return as $contact) {
            $contact['character_id'] = $sso->character_id;
            array_push($contracts, PersonalContract::updateOrCreate(['contact_id' => $contact['contact_id'], 'character_id' => $sso->character_id], $contract));
        }
        return $contracts;
    }
}
