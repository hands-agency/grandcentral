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
	protected $_admin = -1;
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
		if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && !$_SESSION['user']->exists()))
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
	public function is_admin()
	{
		if ($this->_admin === -1)
		{
			foreach ($this['group']->unfold() as $group)
			{
				if ($group['admin']->get() === true)
				{
					$this->_admin = true;
					return true;
				}
			}
			$this->_admin = false;
		}
		// echo 'no';
		return $this->_admin;
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
	//	Les admins peuvent tout voir
		if ($this->is_admin())
		{
			return true;
		}
	//	site
		else
		{
			if (env == 'site')
			{
				return true;
			}
		}
		return false;
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
		$_SESSION['user'] = null;
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