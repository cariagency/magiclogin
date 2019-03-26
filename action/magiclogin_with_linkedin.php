<?php
/**
 * Fichier gérant le login avec google
 *
 * @plugin     MagicLogin
 * @copyright  2013
 * @author     Cédric
 * @licence    GNU/GPL
 * @package    SPIP\Magiclogin\Installation
 */

if (!defined('_ECRIRE_INC_VERSION')) return;



function action_magiclogin_with_linkedin_dist() {
	if (isset($GLOBALS['visiteur_session']['statut'])
	  AND $GLOBALS['visiteur_session']['statut'])
		return;

	include_spip("inc/config");
	include_spip("inc/filtres");
	include_spip("inc/session");
	include_spip('inc/headers');

	include_spip("lib/linkedin/vendor/autoload");


	$client_id = lire_config('magiclogin/linkedin_client_id');
	$client_secret = lire_config('magiclogin/linkedin_client_secret');

	$redirect_uri = url_absolue('magiclogin.api/linkedin/callback');

	$provider = new League\OAuth2\Client\Provider\LinkedIn([
	    'clientId'          => $client_id,
	    'clientSecret'      => $client_secret,
	    'redirectUri'       => $redirect_uri,
	]);

	if (!_request('code')) {

	    // If we don't have an authorization code then get one
	    $authUrl = $provider->getAuthorizationUrl();
	    session_set('linkedin_oauth2state', $provider->getState());
	    redirige_par_entete($authUrl);

	// Check given state against previously stored one to mitigate CSRF attack
	} elseif (empty(_request('state')) || (_request('state') !== session_get('linkedin_oauth2state'))) {
	    session_set('linkedin_oauth2state', null);
	    spip_log("LinkedIn Login invalid state","magiclogin"._LOG_ERREUR);

	} else {

	    // Optional: Now you have a token you can look up a users profile data
	    try {

		    // Try to get an access token (using the authorization code grant)
		    $token = $provider->getAccessToken('authorization_code', [
		        'code' => _request('code')
		    ]);

	        // We got an access token, let's now get the user's details
	        $userData = $provider->withResourceOwnerVersion(2)->getResourceOwner($token);

			$auteur = magiclogin_informer_linkedinaccount($userData);
			if (!isset($auteur['id_auteur'])){
				// si pas trouvé, on redirige vers l'inscription en notant en session les infos collectees
				// pour le pre-remplissage
				include_spip("inc/session");
				session_set("magiclogin_pre_signup",$auteur);
				// et rediriger vers la page de signup
				$GLOBALS['redirect'] = parametre_url(generer_url_public("signup","",true),"redirect",$redirect,"&");
			}
			else {
				// loger l'auteur
				include_spip("inc/auth");
				auth_loger($auteur);
				// et voila
				$GLOBALS['redirect'] = $redirect;
			}

	    } catch (Exception $e) {

	        // Failed to get user details
			if (_request("error")){
				spip_log("LinkedIn Login error : ".$e->getMessage(),"magiclogin"._LOG_ERREUR);
			}
	    }
	}

}


/**
 * Retrouver l'auteur associe aux tokens Twitter
 * et si il n'existe pas le pre-remplir a partir des infos collectees aupres de Twitter
 *
 * @param int $user_id
 * @param object $google
 *
 * @return array
 */
function magiclogin_informer_linkedinaccount($userData){
	if (!isset($userData->id) || $userData->id) {
		spip_log("LinkedIn Login missing userData : ".var_export($userData),"magiclogin"._LOG_ERREUR);
		return FALSE;
	}
	// chercher l'auteur avec ce user_id google
	if (!$infos = sql_fetsel("*",
		"spip_auteurs",
		"statut!=" . sql_quote('5poubelle') . " AND linkedin_id=" . sql_quote($userData->id, '', 'varchar'))
	){
		// si pas trouve, on pre - rempli avec les infos de Google
		$infos = array();
		$infos['source'] = "linkedin";
		$infos['linked_id'] = $userData->id;
		$infos['nom'] = $userData->name;

		$infos['email'] = $userData->email;

		$infos['login'] = $userData->email;
		$infos['logo'] = $userData->picture;
	}

	return $infos;
}



function magiclogin_signup_with_linkedin_dist($desc, $pre_signup_infos){
	$desc['linkedin_id'] = $pre_signup_infos['linkedin_id'];
	return $desc;
}