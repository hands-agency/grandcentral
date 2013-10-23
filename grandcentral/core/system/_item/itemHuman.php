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
	public function can($action, itemPage $page)
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
				// print'<pre>';print_r($this);print'</pre>';
			//	si la page n'a pas de group associé, 
				if ($page['group']->is_empty())
				{
				//	TODO : déplacer cette partie du code dans la class itemPage
				//	on cherche la page parente
					$q = 'SELECT itemid FROM `_rel` WHERE `item`="page" AND `key`="child" AND `relid`=:id';
					$d = array('id' => $page['id']->get());
					$db = database::connect('site');
					$r = $db->query($q, $d);
				//	si on trouve une id
					if ($r['count'] > 0)
					{
					//	on cherche la page parente
						$parent = cc('page', $r['data'][0]['itemid']);
					//	si la page parente existe dans la bdd, et qu'elle a des groupes, on copie ses groupes 
						if ($parent->exists() && !$parent['group']->is_empty())
						{
							$page['group'] = $parent['group']->get();
						}
						else
						{
							return true;
						}
					}
				//	sinon, on valide
					else
					{
						return true;
					}
				}
				
				foreach ($page['group']->get() as $authorized_group)
				{
					if (in_array($authorized_group, $this['group']->get()))
					{
						return true;
					}
				}
				
				// print'<pre>page : ';print_r($this['group']);print'</pre>';
				// print'<pre>page : ';print_r($_SESSION['user']['group']);print'</pre>';
				
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
 * Save item into database
 *
 * @access  public
 */
	public function save()
	{
		parent::save();
		if ($_SESSION['user']['id']->get() == $this['id']->get()) $this->login();
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