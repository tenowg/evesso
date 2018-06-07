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

    // public function getTitles($userOrApplicant = null) {        
    //     if (!$userOrApplicant) {
    //         $userOrApplicant = \Auth::user();
    //     }

    //     $this->checkExpired($userOrApplicant);

    //     $uri = sprintf('characters/%s/titles/', $userOrApplicant->character_id);

    //     if ($userOrApplicant instanceof User) {
    //         return $this->callEsiAuth($userOrApplicant->tokens->access_token, $uri, []);
    //     } else {
    //         return $this->callEsiAuth($userOrApplicant->access_token, $uri, []);
    //     }
    // }

    // /**
    //  * character_id can remain null, if you want to use logged in user
    //  */
    // public function getCharacterPublic($character_id = null, $access_token = null) {
    //     if (!$character_id) {
    //         $user = \Auth::user();
    //         $character_id = $user->character_id;
    //     }

    //     $uri = sprintf('characters/%s/', $character_id);

    //     return $this->callEsi($uri, []);
    // }

    // public function getCharacterMail($character_id, $access_token) {
    //     $uri = sprintf('characters/%s/mail/', $character_id);

    //     return $this->callEsiAuth($access_token, $uri, []);
    // }

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