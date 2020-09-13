<?php

namespace EveEsi;

use Socialite;
use GuzzleHttp\Client;
use Carbon\Carbon;
use EveSSO\EveSSO;
use EveEsi\Scopes;
use EveSSO\EsiExpireTimes;
use EveSSO\Exceptions\InvalidScopeException;

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

    public function hasScope(EveSSO $sso, string $scope) {
        return in_array($scope, $sso->scopes);
    }

    /**
     * @return mixed boolean || object (boolean false will indicate Etag)
     */
    public function callEsiAuth(EveSSO $user, $uri, array $params, string $scope = null, EsiExpireTimes $etag = null, string $method = 'GET', $body = null, $recursive = false) {
        if ($scope != null && !$this->hasScope($user, $scope)) {
            throw new InvalidScopeException();
        }

        $this->checkExpired($user);

        $client = new Client();

        $headers = array(
            'User-Agent' => config('eve-sso.useragent'),
            'Authorization' => 'Bearer ' . $user->access_token
        );

        if ($etag != null) {
            if (!$etag->expired()) {
                return null;
            }

            $headers['If-None-Match'] = $etag->etag;
        }

        $options = array('headers' => $headers, 'query' => $params);

        if ($body != null) {
            $options['json'] = $body;
        }

        $res = $client->request($method, $this->base_url . $uri, $options);

        $status = $res->getStatusCode();
        if ($status == 304 && $etag != null) {
            $etag->expires = Carbon::now()->tz('UTC')->diffInSeconds(new Carbon($res->getHeader('Expires')[0]));
            $etag->save();
            return null;
        } else if ($status == 403 || $status == 401 || $status == 404 || $status == 420 || $status == 500) {
            // Forbidden
            return null;
        } else if ($etag != null) {
            $etag->etag = $res->getHeader('ETag')[0]; // get headers...
            $etag->expires = Carbon::now()->tz('UTC')->diffInSeconds(new Carbon($res->getHeader('Expires')[0]));
            $etag->save();
        }

        $x_pages = $res->getHeader('X-Pages');
        $max_pages = 0;
        if ($x_pages) {
            $max_pages = +$x_pages[0] ?: 1;
        }
        $body_res = json_decode($res->getBody(), true);

        // recursive calls
        if (!$recursive) {
            for ($page = 2; $page <= $max_pages; $page++) {
                $params['page'] = $page;
                $res_page = $this->callEsiAuth($user, $uri, $params, $scope, null, $method, $body, true);
                $body_res = array_merge($body_res, $res_page);
            }
        }
        return $body_res;
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
}
