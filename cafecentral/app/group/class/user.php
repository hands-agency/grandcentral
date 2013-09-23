<?php
/**
 * The user item of Café Central
 *
 * Fonctionnalités désirées :
 * 	http://stackoverflow.com/questions/549/the-definitive-guide-to-forms-based-website-authentication
 * 	https://www.owasp.org/index.php/Guide_to_Authentication
 * 	http://fishbowl.pastiche.org/2004/01/19/persistent_login_cookie_best_practice/
 *	http://stackoverflow.com/questions/4795385/how-do-you-use-bcrypt-for-hashing-passwords-in-php
 * 
 * 		identification login (pseudo ou email) + mot de passe
 *		autologin http://ellislab.com/forums/viewthread/113781/
 * 		une seule connexion par compte ?
 * 		Aucun mot de passe en clair dans la base de données
 * 		Système mot de passe perdu regénère un nouveau mot de passe (impossible de récupérer l'ancien)
 * 
 * Se protéger contre :
 * le vol de session (man in the middle)
 * 		principe : mettre un place un système de ticket.
 * 		ressources :
 * 		http://guillaume-affringue.developpez.com/securite/chiffrement/?page=4#LIV
 * 		
 * le vol de mot de passe (man in the middle)
 * 		principe : crypter les mots de passe en js avant le submit du formulaire
 * 		ressources :
 * 		http://guillaume-affringue.developpez.com/securite/chiffrement/?page=3#LIII
 * 		sha1
 * 
 * les attaques par dictionnaire 
 * 		principe : utilisez des outils de grain de sel (salt) unique à chaque utilisateur
 * 		ressources :
 * 		http://guillaume-affringue.developpez.com/securite/chiffrement/?page=3#LIII
 * 		
 * 
 * les attaques de type brute force
 * 		principe : mettre un place un système de ticket.
 * 		ressources :
 * 		http://www.siteduzero.com/tutoriel-3-34510-eviter-les-attaques-par-force-brute.html
 * 		http://www.siteduzero.com/tutoriel-3-61380-un-anti-brute-force-leger-et-rapide.html
 * 
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class user extends _items
{
	const round = 12;
	protected $hash;
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  only site
 * @access	public
 */
	public function __construct($param = null, $env = env)
	{
		$env = 'site';
		parent::__construct($param, $env);
	}
/**
 * Vérifie la validité d'un mot de passe
 *
 * @param	string	le mot de passe à vérifier
 * @access	public
 */
	public function is_valid_password($password)
	{
		$bcrypt = new bcrypt(self::round);
		return $bcrypt->verify($password, $this->data->data['password']);
	}
/**
 * AutoLog the user, looking for a previous session or an autologin cookie or log as anonymous user
 *
 * @access	public
 */
	public function guess()
	{
		ini_set('session.use_trans_sid', false);
		ini_set('session.cache_expire', 60);
		ini_set('session.cookie_httponly', true);
		session_start();
	#	session_regenerate_id(true);
		
	//	on commence par chercher l'utilisateur en session
		if (isset($_SESSION['user']) && $_SESSION['user']->exists())
		{
			$_SESSION['user']->login();
			// print '<pre>';print_r('session');print'</pre>';
		}
	//	si pas de session
		elseif (isset($_COOKIE['autologin']))
		{
			$token = new token($_COOKIE['autologin']);
			if ($token->is_valid())
			{
				// print '<pre>';print_r('autolog');print'</pre>';
				$user = $token->get_reference();
				if ($user !== null)
				{
					$user->login();
					$_SESSION['user']['autologin'] = true;
				//	on régénère le token
					$token = new token();
					$token->generate($user, '+1 day');
					$token->save();
					$token->set_cookie('autologin');
				}
			}
		}
	//	sinon, on log l'utilisateur anonyme
		if (!isset($_SESSION['user']))
		{
			$this->get('anonymous');
			$this->login();
			// print '<pre>';print_r('anonyme');print'</pre>';
		}
		// print '<pre>'.session_name().' '.session_id(). ' : ';print_r($_SESSION);print'</pre>';
	}
/**
 * Logs the user in the session
 *
 * @access	public
 */
	public function login()
	{
		$_SESSION['user'] = $this;
	}
/**
 * Logs the user in the session
 *
 * @access	public
 */
	public function logout()
	{
		session_destroy();
	}

/**
 * Returns the right to perform an action on an item
 *
 * @param	mixed	le tag d'un objet ou un objet
 * @return	bool	true ou false
 * @access	public
 */
	public function can($action, $item)
	{
		return true;
	}
	
	public function get_ip()
	{
		if(getenv('HTTP_X_FORWARDED_FOR'))
        {
            $this->ip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif(getenv('HTTP_CLIENT_IP'))
        {
            $this->ip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $this->ip = getenv('REMOTE_ADDR');
        }
	}
}
?>