<?php namespace App\Http\Controllers;

use Config;
use \League\OAuth2\Client\Provider\GenericProvider;

class HomeController extends Controller
{
  public $provider;
  public $tokenInfo;

  public function __construct()
  {
    $this->provider = new GenericProvider([
      'clientId' => env('YOOV_CLIENT_ID'),
      'clientSecret' => env('YOOV_CLIENT_SECRET'),
      'redirectUri' => env('YOOV_REDIRECT_URI'),
      'urlAuthorize' => env('YOOV_URL_AUTHORIZE'),
      'urlAccessToken' => env('YOOV_URL_ACCESS_TOKEN'),
      'urlResourceOwnerDetails' => env('YOOV_URL_RESOURCE_OWNER_DETAILS'),
      'scopes' => env('YOOV_SCOPES'),
    ]);
  }

  public function index()
  {
    $authorizationUrl = $this->provider->getAuthorizationUrl();

    // Get the state generated for you and store it to the session.
    session(['oauth2state' => $this->provider->getState()]);

    // Redirect the user to the authorization URL.
    header('Location: ' . $authorizationUrl);
    exit;
  }

  public function callback()
  {
    if (
      empty($_GET['state']) ||
      (session()->has('oauth2state') &&
        $_GET['state'] !== session('oauth2state'))
    ) {
      if (session()->has('oauth2state')) {
        session()->forget('oauth2state');
      }
      exit('Invalid state');
    } else {
      try {
        // Try to get an access token using the authorization code grant.
        $tokenInfo = $this->provider->getAccessToken('authorization_code', [
          'code' => $_GET['code']
        ]);
        session(['code'=>$_GET['code']]);

        session(['accessToken' => $tokenInfo->getToken()]);
        session(['refreshToken' => $tokenInfo->getRefreshToken()]);
        session(['expiredIn' => date('Y-m-d H:i:s', $tokenInfo->getExpires())]);
        session(['expired' => $tokenInfo->hasExpired()]);

        return redirect('/teams');

      } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        // Failed to get the access token or user details.
        exit($e->getMessage());
      }
    }
  }

  public function getTeams() {
    $result = [
      'accessToken' =>  session('accessToken'),
      'refreshToken' => session('refreshToken'),
      'expiredIn' => session('expiredIn'),
      'expired' =>  session('expired'),

      'teams' => $this->fetchTeams(),
    ];

    return view('home', $result);
  }

  public function fetchTeams()
  {
    $token = session('accessToken');

    $request = $this->provider->getAuthenticatedRequest(GenericProvider::METHOD_GET,
      'https://joa.yoov.com/api/v1/t/teams?page=0&size=10',
      $token
    );

    $response = $this->provider->getParsedResponse($request);

    if (false === is_array($response)) {
      throw new UnexpectedValueException(
        'Invalid response received from Authorization Server. Expected JSON.'
      );
    }
    $result = array_key_exists('content', $response) ? $response['content'] : [];
    return $result;
  }

}
