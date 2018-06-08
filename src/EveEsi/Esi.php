<?php

namespace EveEsi;

use Socialite;
use App\User;
use App\Tokens;
use App\Applicant;
use GuzzleHttp\Client;
use Carbon\Carbon;
use EveSSO\EveSSO;

class Esi {
    private $base_url;

    public function __construct() {
        $this->base_url = config('eve-sso.baseurl');
    }

    public function checkExpired(EveSSO $user) {
        if ($user instanceof EveSSO) {
            if($user->expired()) {
                $prov = Socialite::driver('eveonline')->refreshToken($user->refresh_token);
                $user->access_token = $prov;
                $user->save();
            }
        }
    }

    public function callEsiAuth(EveSSO $user, $uri, array $params) {
        $this->checkExpired($user);

        $client = new Client();

        $headers = array(
            'User-Agent' => config('eve-sso.useragent'),
            'Authorization' => 'Bearer ' . $user->access_token
        );

        $options = array('headers' => $headers, 'query' => $params);

        $res = $client->request('GET', $this->base_url . $uri, $options);
        
        return json_decode($res->getBody(), true);
    }

    public function callEsi($uri, array $params) {
        $client = new Client();

        $headers = array(
            'User-Agent' => config('eve-sso.useragent')
        );

        $options = array('headers' => $headers, 'query' => $params);

        $res = $client->request('GET', $this->base_url . $uri, $options);
        
        return json_decode($res->getBody(), true);
    }

    public function getCharacterBalance($character_id, $access_token) {
        $uri = sprintf('characters/%s/wallet/', $character_id);

        return $this->callEsiAuth($access_token, $uri, []);
    }

    public function getCharacterJournal($character_id, $access_token, $page = 1) {
        $uri = sprintf('characters/%s/wallet/journal/', $character_id);
        $params = [
            'page' => $page
        ];

        return $this->callEsiAuth($access_token, $uri, $params);
    }

    public function getCharacterSkills($character_id, $access_token) {
        $uri = sprintf('characters/%s/skills/', $character_id);

        return $this->callEsiAuth($access_token, $uri, []);
    }
}