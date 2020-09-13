<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;
use EveSSO\CharacterAssets;

use EveEsi\Scopes;
use EveSSO\Exceptions\InvalidScopeException;

class Assets extends BaseEsi {
    /**
     * @var Esi
     */
    private $esi;

    public function __construct(Esi $e) {
        $this->esi = $e;
        parent::__construct();
    }

    public function getAssetNames(EveSSO $sso, array $ids) {
        $uri = sprintf('characters/%s/assets/names/', $sso->character_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_ASSETS, null, 'POST', $ids);
        }

        $return = $this->esi->callEsiAuth($sso, $uri, [], null, null, 'POST', $ids);

        return $return;
    }

    public function getCharacterAssets(EveSSO $sso) {
        $uri = sprintf('characters/%s/assets/', $sso->character_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_ASSETS);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'character_assets-' . $sso->character_id]);
        if (!$expires->expired()) {
            return CharacterAssets::whereCharacterId($sso->character_id)->get();
        }

        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_ASSETS, $expires);
        if (!$return) {
            return CharacterAssets::whereCharacterId($sso->character_id)->get();
        }

        $assets = array();
        
        foreach($return as $asset) {
            $asset['character_id'] = $sso->character_id;
            array_push($assets, CharacterAssets::updateOrCreate(['item_id' => $asset['item_id'], 'character_id' => $sso->character_id], $asset));
        }

        if (count($assets) > 0) {
            $date = $assets[0]->updated_at;
            CharacterAssets::where("updated_at", "<", $date)->whereCharacterId($sso->character_id)->delete();
        }
    }
}