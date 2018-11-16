<?php

namespace EveEsi;

use Carbon\Carbon;

use EveEsi\BaseEsi;
use EveEsi\Esi;

use EveSSO\EsiExpireTimes;
use EveSSO\EveSSO;

use EveEsi\Scopes;
use EveSSO\Exceptions\InvalidScopeException;
use EveSSO\CharacterIndustryJobs;
use EveSSO\CorporationPublic;
use App\CorporationIndustryJobs;

class Industry extends BaseEsi {
    /**
     * @var Esi
     */
    private $esi;

    public function __construct(Esi $e)
    {
        $this->esi = $e;
        parent::__construct();
    }

    public function getCharacterIndustryJobs(EveSSO $sso) {
        $uri = sprintf('characters/%s/industry/jobs/', $sso->character_id);

        if ($this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_INDUSTRY_JOBS);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_industry_jobs-' . $sso->character_id]);

        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CHARACTER_INDUSTRY_JOBS, $expires);
        if (!$return) {
            return CharacterIndustryJobs::whereInstallerId($sso->character_id)->get();
        }

        $jobs = array();
        foreach($return as $job) {
            if (array_key_exists('completed_date', $job)) {
                $job['completed_date'] = new Carbon($job['completed_date']);
            }
            $job['end_date'] = new Carbon($job['end_date']);
            if (array_key_exists('pause_date', $job)) {
                $job['pause_date'] = new Carbon($job['pause_date']);
            }
            $job['start_date'] = new Carbon($job['start_date']);
            array_push($jobs, CharacterIndustryJobs::updateOrCreate(['job_id' => $job['job_id']], $job));
        }

        return $jobs;
    }

    public function getCorporationIndustryJobs(EveSSO $sso, CorporationPublic $corp) {
        $uri = sprintf('corporations/%s/industry/jobs/', $corp->corporation_id);

        if ($this->commit_data) {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_INDUSTRY_JOBS);
        }

        $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_corporations_industry_jobs-' . $corp->corporation_id]);

        $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::READ_CORP_INDUSTRY_JOBS, $expires);
        if (!$return) {
            return CorporationIndustryJobs::whereCorporationId($corp->corporation_id)->get();
        }

        $jobs = array();
        foreach($return as $job) {
            $job['corporation_id'] = $corp->corporation_id;
            if (array_key_exists('completed_date', $job)) {
                $job['completed_date'] = new Carbon($job['completed_date']);
            }
            $job['end_date'] = new Carbon($job['end_date']);
            if (array_key_exists('pause_date', $job)) {
                $job['pause_date'] = new Carbon($job['pause_date']);
            }
            $job['start_date'] = new Carbon($job['start_date']);
            array_push($jobs, CharacterIndustryJobs::updateOrCreate(['job_id' => $job['job_id']], $job));
        }

        return $jobs;
    }
}