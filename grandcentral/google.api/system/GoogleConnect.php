<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 * 
 * @package        Google API OAuth 2 Connection
 * @author        Virgil B.
 * @author        Sylvain Frigui <sf@hands.agency>
 * @copyright    Copyright © 2004-2014, Grand Central
 * @license        http://www.cafecentral.fr/fr/licences GNU Public License
 * @access        public
 * @link        http://www.cafecentral.fr/fr/wiki
 */
 
 
class GoogleConnect
{
     var    $client_id,
            $client_secret,
            $redirect_uri,
            //$user_id,
            $email_address;
     var    $state = "";
            
     var    $scopes = array();
            
     var    $service;
     
     var    $credentials;
     
	function __construct($params,$scopes,$getauthorization=false)
	{ 
		$this->scopes = $scopes;
		
		foreach($params as $key => $param)
		{
             $this->$key = $param;
		}
		$this->credentials = $this->getStoredCredentials($this->email_address);
         
		if (empty($this->credentials))
		{
			if (isset($_GET['code']))
			{
				$this->credentials = $this->requestCredentials($_GET['code'],"");
			}
            elseif (true === $getauthorization)
			{
				header('Location:'.$this->getAuthorizationUrl($this->email_address));    
                die;
			}
			else
			{
                trigger_error('You need an active tokken');
				die();
            }
		}
        
     }
     
     
    function getCredentials(){
        return $this->credentials;
    }
/**
 * Retrieved stored credentials for the provided user ID.
 *
 * @param String $userId User's ID.
 * @return String Json representation of the OAuth 2.0 credentials.
 */
    function getStoredCredentials($userId) {
        
        //TODO CREATE Item & table 'googleapicredentials' If it doesn't exist
        
        $cred = i('googleapicredentials');
        $cred->get(array('account'=>$userId));
        if(!$cred['credential']->is_empty())
            return $cred['credential']->get();
        else
            return false;
    }

/**
 * Store OAuth 2.0 credentials in the application's database.
 *
 * @param String $userId User's ID.
 * @param String $credentials Json representation of the OAuth 2.0 credentials to
                              store.
 */
    function storeCredentials($userId, $credentials) {
      
        $cred = i('googleapicredentials');
        $cred->get(array('account'=>$userId));
        $cred['account'] = $userId;
        $cred['credential'] = $credentials;
        $cred->save();
      
    }

/**
 * Exchange an authorization code for OAuth 2.0 credentials.
 *
 * @param String $authorizationCode Authorization code to exchange for OAuth 2.0
 *                                  credentials.
 * @return String Json representation of the OAuth 2.0 credentials.
 * @throws CodeExchangeException An error occurred.
 */
    function exchangeCode($authorizationCode) {
      try {
        
        $client = new Google_Client();

        $client->setClientId($this->client_id);
        $client->setClientSecret($this->client_secret);
        $client->setRedirectUri($this->redirect_uri);
        //$_GET['code'] = $authorizationCode;
        $auth = $client->authenticate($authorizationCode);
        
        return $auth;
        
      } catch (Google_AuthException $e) {
        print 'An error occurred: ' . $e->getMessage();
        //throw new Exception($e->getMessage())
      }
      return false;
    }

/**
 * Send a request to the UserInfo API to retrieve the user's information.
 *
 * @param String credentials OAuth 2.0 credentials to authorize the request.
 * @return Userinfo User's information.
 * @throws NoUserIdException An error occurred.
 */
    function getUserInfo($credentials) {
      $apiClient = new Google_Client();
      //$apiClient->setUseObjects(true);
      $apiClient->setAccessToken($credentials);
      $userInfoService = new Google_Service_Oauth2($apiClient);
      $userInfo = null;
      try {
        $userInfo = $userInfoService->userinfo->get();
      } catch (Google_Exception $e) {
        print 'An error occurred: ' . $e->getMessage();
      }
      if ($userInfo != null && $userInfo->getId() != null) {
        return $userInfo;
      } else {
        return false;
      }
      return false;
    }

/**
 * Retrieve the authorization URL.
 *
 * @param String $emailAddress User's e-mail address.
 * @param String $state State for the authorization URL.
 * @return String Authorization URL to redirect the user to.
 */
    function getAuthorizationUrl($emailAddress="") {
          

      $client = new Google_Client();
      $client->setScopes($this->scopes);
      $client->setClientId($this->client_id);
      $client->setClientSecret($this->client_secret);
      $client->setRedirectUri($this->redirect_uri);
      $client->setState($this->state);
      
      //offline access auth request
      $client->setAccessType('offline');
      $client->setApprovalPrompt('force');
      
      $tmpUrl = parse_url($client->createAuthUrl());
      $query = explode('&', $tmpUrl['query']);
      $query[] = 'user_id=' . urlencode($emailAddress);
      return
          $tmpUrl['scheme'] . '://' . $tmpUrl['host'] . $tmpUrl['port'] .
          $tmpUrl['path'] . '?' . implode('&', $query);
    }

/*

*/

/**
 * Retrieve credentials using the provided authorization code.
 *
 * This function exchanges the authorization code for an access token and
 * queries the UserInfo API to retrieve the user's e-mail address. If a
 * refresh token has been retrieved along with an access token, it is stored
 * in the application database using the user's e-mail address as key. If no
 * refresh token has been retrieved, the function checks in the application
 * database for one and returns it if found or throws a NoRefreshTokenException
 * with the authorization URL to redirect the user to.
 *
 * @param String authorizationCode Authorization code to use to retrieve an access
 *                                 token.
 * @param String state State to set to the authorization URL in case of error.
 * @return String Json representation of the OAuth 2.0 credentials.
 * @throws NoRefreshTokenException No refresh token could be retrieved from
 *         the available sources.
 */
 
    function requestCredentials($authorizationCode, $state) {
      $emailAddress = '';
      
        $credentials = $this->exchangeCode($authorizationCode);
        if($credentials){
            $userInfo = $this->getUserInfo($credentials);
            if($userInfo){
                $emailAddress = $userInfo->getEmail();
                $userId = $userInfo->getId();
                $credentialsArray = json_decode($credentials, true);
                if (isset($credentialsArray['refresh_token'])) {
                  $this->storeCredentials($emailAddress, $credentials);
                  return $credentials;
                } else {
                  $credentials = $this->getStoredCredentials($emailAddress);
                  $credentialsArray = json_decode($credentials, true);
                  if ($credentials != null &&
                      isset($credentialsArray['refresh_token'])) {// refresh_token is needed for offline access token exchange which expires every hour
                    return $credentials;
                  }
                }    
            }else{
                print 'No e-mail address could be retrieved.';
            }
        }else{
            print 'An error occurred during code exchange.';
        } 
      // No refresh token has been retrieved.
      return false;
    }




 }
 ?>