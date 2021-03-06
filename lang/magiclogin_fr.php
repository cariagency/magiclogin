<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP

if (!defined('_ECRIRE_INC_VERSION')) return;
 
$GLOBALS[$GLOBALS['idx_lang']] = array(

	// M
	'magiclogin_titre' => 'MagicLogin',

	// C
	'cfg_exemple' => 'Exemple',
	'cfg_exemple_explication' => 'Explication de cet exemple',
	'cfg_titre_parametrages' => 'Paramétrages',

	'info_page_signup' => 'C\'est la première fois que vous vous connectez avec <b>@social_source@</b>.<br />
Nous avons juste besoin de quelques informations pour vous identifier.',

	// T
	'titre_page_configurer_magiclogin' => 'Configuration de MagicLogin',
	'titre_page_signup' => 'Bonjour@nom@',

	'label_taille_icones' => 'Taille des icones pour les liens de login',
	'label_taille_icones_16' => '16px',
	'label_taille_icones_24' => '24px',
	'label_taille_icones_32' => '32px',
	'label_taille_icones_48' => '48px',

	'explication_facebook_api_oauth' => 'Créez une application Facebook <a href="https://developers.facebook.com/apps">dans l\'espace développeurs (https://developers.facebook.com/apps)</a>.
Entrez ci-dessous les clés d\'identification et enregistrez (<a href="http://www.designaesthetic.com/2012/03/02/create-facebook-login-oauth-php-sdk/">Plus d\'aide</a>).',
	'label_facebook_consumer_key' => 'Cl&eacute; cliente (<em>App ID</em>)',
	'label_facebook_consumer_secret' => 'Cl&eacute; secr&#232;te (<em>App Secret</em>)',
	'legend_api_facebook' => 'Application Facebook',

	'explication_google_api_oauth' => 'Créez une application Google <a href="https://console.developers.google.com/">dans la console développeurs (https://console.developers.google.com/)</a> avec l\'url de redirection <tt>@url_redirect@</tt>.
Entrez ci-dessous les clés d\'identification et enregistrez (<a href="http://phppot.com/php/php-google-oauth-login/">Plus d\'aide</a>).',
	'label_google_client_id' => 'Identifiant Client',
	'label_google_client_secret' => 'Code secret Client',
	'label_google_api_key' => 'Clé de l\'API',
	'legend_api_google' => 'Application Google',

	'explication_linkedin_api_oauth' => 'Créez une application LinkedIn <a href="https://www.linkedin.com/developers/apps">dans la console développeurs (https://www.linkedin.com/developers/apps)</a> avec l\'url de redirection <tt>@url_redirect@</tt>.
Entrez ci-dessous les clés d\'identification et enregistrez (<a href="https://phppot.com/php/simple-php-linkedin-oauth-login-integration/">Plus d\'aide</a>).',
	'label_linkedin_client_id' => 'Identifiant Client',
	'label_linkedin_client_secret' => 'Code secret Client',
	'legend_api_linkedin' => 'Application LinkedIn',

	'label_activer_facebook_oui' => 'Activer le login rapide via Facebook',
	'label_activer_twitter_oui' => 'Activer le login rapide via Twitter',
	'label_activer_google_oui' => 'Activer le login rapide via Google',
	'label_activer_linkedin_oui' => 'Activer le login rapide via LinkedIn',
	'label_activer_persona_oui' => 'Activer le login rapide via Persona',
	'explication_activer_twitter' => 'Installez et configurez le plugin <a href="http://plugins.spip.net/twitter">Twitter</a> pour utiliser le login rapide via Twitter.'

);

?>