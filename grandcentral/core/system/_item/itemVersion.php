<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemVersion extends _items
{
/**
 * Détermine en fonction du contexte la version à afficher
 *
 * @access	public
 */
	public function guess()
	{
	//	The currently displayed admin
	//	$pref = $_SESSION['user']['pref'];
	//	$pref['admin']['version'] = '1';
	//	$_SESSION['user']['pref'] = $pref;
	//	si on a une version qui nous a été donnée par la classe boot
		if ($this->get_env() == 'site' && defined('SITE_VERSION') && SITE_VERSION != null)
		{
			$param = SITE_VERSION;
		}
	//	Otherwise, detect browser language
		elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			$lang = mb_substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			$param['lang'] = $lang;
		}

		if (isset($param) && !empty($param))
		{
			$this->get($param);
		}

	//	Nothing? Just get the first version.
		if (!$this->exists())
		{
			$this->get(VERSION_DEFAULT);
		}
		return $this;
	}

	public function get_url()
	{
		$url = (defined('VERSION_'.mb_strtoupper($this['key']))) ? constant('VERSION_'.mb_strtoupper($this['key'])) : SITE_URL;
		return ('site' == $this->get_env()) ? $url : ADMIN_URL;
	}

	public static function register()
	{
		require(DOCUMENT_ROOT.'/'.boot::ini_file);

		foreach ($site as $site)
		{
			foreach ((array) $site['url'] as $key => $url)
			{
				if ($site['key'] == SITE_KEY)
				{
					if (!empty($key))
					{
						if (!defined('VERSION_DEFAULT'))
						{
							define('VERSION_DEFAULT', $key);
						}
						$version = 'VERSION_';
						// define($version.'KEY', mb_strtoupper($key));
						define($version.''.mb_strtoupper($key), $url);
					}
					else
					{
						$q = 'SELECT lang FROM version LIMIT 1';
						$db = database::connect('site');
						$r = $db->query($q);
						define('VERSION_DEFAULT', $r['data'][0]['lang']);
					}
				}
			}
		}
	}
}
?>
