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
use EveSSO\CorporationAsset;
use EveSSO\CorporationTitles;
use App\CorporationStructures;

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
        $return = $this->esi->callEsi($uri, []);

        if (!$this->commit_data) {
            return $return;
        }

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
        $uri = sprintf('corporations/%s/blueprints/', $sso->characterPublic->corporation_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_BLUEPRINTS);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporation_blueprints-' . $sso->characterPublic->corporation_id]);
        
        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_BLUEPRINTS, $expires);
        if (!$return) {
            return CorporationBlueprints::whereCorporationId($sso->characterPublic->corporation_id)->get();
        }

        $blueprints = array();
        $update_date = Carbon::now();
        foreach($return as $blueprint) {
            $blueprint['corporation_id'] = $sso->characterPublic->corporation_id;
            $db_print = CorporationBlueprints::updateOrCreate(['item_id' => $blueprint['item_id']], $blueprint);
            if (!$db_print->wasRecentlyCreated) {
                $db_print->touch();
            }
            array_push($blueprints, $db_print);
        }

        CorporationBlueprints::whereDate('updated_at', '<', $update_date)->delete();

        return $blueprints;
    }

    public function getCorporationAssets(EveSSO $sso) {
        $uri = sprintf('corporations/%s/assets/', $sso->characterPublic->corporation_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_ASSETS);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporation_assets-' . $sso->characterPublic->corporation_id]);
        
        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_ASSETS, $expires);
        if (!$return) {
            return CorporationAsset::whereCorporationId($sso->characterPublic->corporation_id)->get();
        }

        $assets = array();
        $update_date = Carbon::now();
        foreach($return as $asset) {
            $asset['corporation_id'] = $sso->characterPublic->corporation_id;
            $db_asset = CorporationAsset::updateOrCreate(['item_id' => $asset['item_id']], $asset);
            if (!$db_asset->wasRecentlyCreated) {
                $db_asset->touch();
            }
            array_push($assets, $db_asset);
        }

        CorporationAsset::whereDate('updated_at', '<', $update_date)->delete();

        return $assets;
    }

    public function getCorporationTitles(EveSSO $sso) {
        $uri = sprintf('corporations/%s/titles/', $sso->characterPublic->corporation_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_TITLES);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporation_titles-' . $sso->characterPublic->corporation_id]);
        
        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_TITLES, $expires);
        if (!$return) {
            return CorporationTitles::whereCorporationId($sso->characterPublic->corporation_id)->get();
        }

        $assets = array();
        $update_date = Carbon::now();
        foreach($return as $asset) {
            $asset['corporation_id'] = $sso->characterPublic->corporation_id;
            $db_asset = CorporationTitles::updateOrCreate(['title_id' => $asset['title_id'], 'corporation_id' => $asset['corporation_id']], $asset);
            if (!$db_asset->wasRecentlyCreated) {
                $db_asset->touch();
            }
            array_push($assets, $db_asset);
        }

        CorporationTitles::whereDate('updated_at', '<', $update_date)->delete();

        return $assets;
    }

    public function getCorporationStructures(EveSSO $sso) {
        $uri = sprintf('corporations/%s/structures/', $sso->characterPublic->corporation_id);

        if (!$this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_STRUCTURES);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporation_structures-' . $sso->characterPublic->corporation_id]);
        
        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_STRUCTURES, $expires);
        if (!$return) {
            return CorporationStructures::whereCorporationId($sso->characterPublic->corporation_id)->get();
        }

        $assets = array();
        $update_date = Carbon::now();
        foreach($return as $asset) {
            if (array_key_exists($asset, 'fuel_expires')) {
                $asset['fuel_expires'] = new Carbon($asset['fuel_expires']);
            }
            if (array_key_exists($asset, 'next_reinforce_apply')) {
                $asset['next_reinforce_apply'] = new Carbon($asset['next_reinforce_apply']);
            }
            if (array_key_exists($asset, 'state_timer_end')) {
                $asset['state_timer_end'] = new Carbon($asset['state_timer_end']);
            }
            if (array_key_exists($asset, 'state_timer_start')) {
                $asset['state_timer_start'] = new Carbon($asset['state_timer_start']);
            }
            if (array_key_exists($asset, 'unanchors_at')) {
                $asset['unanchors_at'] = new Carbon($asset['unanchors_at']);
            }

            $db_asset = CorporationStructures::updateOrCreate(['structure_id' => $asset['structure_id']], $asset);
            if (!$db_asset->wasRecentlyCreated) {
                $db_asset->touch();
            }
            array_push($assets, $db_asset);
        }

        CorporationStructures::whereDate('updated_at', '<', $update_date)->delete();

        return $assets;
    }
}