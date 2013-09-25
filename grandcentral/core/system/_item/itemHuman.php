<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemHuman extends _items
{
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  admin ou site (environnement courant par défaut)
 * @access	public
 */
	public function __construct($env = env)
	{
		$env = 'site';
		parent::__construct($env);
	}
/**
 * Vérifie la validité d'un mot de passe
 *
 * @param	string	le mot de passe à vérifier
 * @access	public
 */
	public function is_valid_password($password)
	{
		return $this['password']->is_valid($password);
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
		
	//	si pas de session on log automatiquement l'utilisateur anonyme
		if (!isset($_SESSION['user']))
		{
			$this->get('anonymous');
			$this->login();
		}
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
/**
 * Détermine en fonction du contexte quelle page afficher
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
 * Get user's IP adress
 *
 * @access	public
 */
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