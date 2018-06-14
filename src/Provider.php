<?php

namespace tenowg\EveSSO;

use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

use EveSSO\EveSSO;

class Provider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'EVEONLINE';

    /**
     * {@inheritdoc}
     */
    protected $scopes = [];

    /**
     * {@inheritdoc}
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://login.eveonline.com/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://login.eveonline.com/oauth/token';
    }

    /**
	 * {@inheritdoc}
	 */
	public function getAccessToken( $code )
	{
		$response = $this->getHttpClient()->post( $this->getTokenUrl(), [
			'headers'     => [ 'Authorization' => 'Basic ' . base64_encode( $this->clientId . ':' . $this->clientSecret ) ],
			'form_params' => $this->getTokenFields( $code ),
		] );

		$this->credentialsResponseBody = json_decode( $response->getBody(), true );

		return $this->parseAccessToken( $response->getBody() );
    }
    
    public function refreshToken($token) {
        $response = $this->getHttpClient()->post( $this->getTokenUrl(), [
			'headers'     => [ 'Authorization' => 'Basic ' . base64_encode( $this->clientId . ':' . $this->clientSecret ) ],
			'form_params' => $this->getRefreshFields( $token ),
		] );

		$this->credentialsResponseBody = json_decode( $response->getBody(), true );

        return $this->credentialsResponseBody['access_token'];
    }

    public function handleDatabase($user) {
        return EveSSO::updateOrCreate(
            [
                'character_id' => $user->user['CharacterID']
            ],
            [
                'name' => $user->name, 
                'access_token' => $user->token, 
                'refresh_token' => $user->refreshToken == null ? '' : $user->refreshToken,
                'expires' => $user->expiresIn,
                'character_owner_hash' => $user->user['CharacterOwnerHash'],
                'scopes' => explode(' ', $user->user['Scopes']),
                'avatar' => $user->avatar
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://login.eveonline.com/oauth/verify', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'       => $user['CharacterID'],
            'nickname' => $user['CharacterName'],
            'name'     => $user['CharacterName'],
            'email'    => $user['CharacterID'] . "@local.com",
            'avatar'   => "https://image.eveonline.com/Character/" . $user['CharacterID'] . "_256.jpg",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getRefreshFields($code)
    {
        return [
            'grant_type' => 'refresh_token',
            'refresh_token' => $code
        ];
    }
}
