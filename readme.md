## Add to Providers/EventServiceProvider

```
/**
 * The event handler mappings for the application.
 *
 * @var array
 */
protected $listen = [
	\SocialiteProviders\Manager\SocialiteWasCalled::class => [
		// add your listeners (aka providers) here
		'tenowg\EveSSO\EveOnlineExtendSocialite@handle',
	],
];
```

## Add to `.env`

```
EVEONLINE_KEY=yourkeyfortheservice
EVEONLINE_SECRET=yoursecretfortheservice
EVEONLINE_REDIRECT_URI=https://example.com/login
```

## Usage

`return Socialite::driver('eveonline')->redirect();`  
`$user = Socialite::driver('eveonline')->user()`  
`$token = Socialite::driver('eveonline')->refreshToken($refresh_token);`  