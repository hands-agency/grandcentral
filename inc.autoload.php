<?php
/**
 * Title: This is the title of this document
 *
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 *
 * Example usage:
 * <code>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </code>
 *
 * @package  (Here, the name of this app)
 * @author   Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class boot
{
  const ini_file 			= 'inc.config.php';	//	le fichier de config
  const admin_dir 		= 'grandcentral';	//	le répertoire racine de cc
  const site_dir 			= 'www';			//	le répertoire racine des sites
  const app_system_dir 	= 'system';			//	le répertoire des fichiers systèmes d'une app
	const app_template_dir 	= 'template';		//	le répertoire des apps
  const app_ini_file 		= 'config.ini';	 	//	le nom des fichiers de configuration des apps
  const index_enabled		= false;			//	pour afficher la page index si on ne trouve pas de site
	const app_maintenance 	= 'maintenance';		//	le répertoire de la maintenance

	private $boot 			= 'core';			//	l'app à charger par défaut
	private $root;
	// private $directory;
	private $relative_root;
	private $uri;
	private $url;
	private $domain;
	private $env;
	private $admin;
	private $site;
	private $core_root;

/**
 * What is this method about
 *
 * @access	public
 */
	public function __construct()
	{

		//	ouverture du tampon
		if(!ob_start("ob_gzhandler")) ob_start();
		//	prise en charge de l'autoload des classes
		spl_autoload_register('boot::autoload');
		//	recherche de l'url active
		$this->get_url();
		// chargement du fichier de config
		if ($this->get_config())
		{
			//	définition des constantes
			$this->define_config();
			//	chargement du coeur
			self::get($this->core_root);
		}
		// installation
		else
		{
			$this->env = 'admin';
			$this->boot = 'install';
			$this->root = realpath(dirname(__FILE__));
			$this->admin['root'] = $this->root.'/'.self::admin_dir;
			$this->define('SITE_ROOT', $this->root.'/'.self::site_dir);
			$this->core_root = $this->admin['root'].'/'.$this->boot;
			$this->define_config();
			self::get($this->core_root);
			require $this->core_root.'/system/install.php';
			exit;
		}
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public function __destruct()
	{
	//	Stop buffering
		if (ob_get_length() > 0) ob_end_flush();
	}

/**
 * Get data form the config file
 *
 * @return	mixed	$this or false
 * @access	private
 */
	private function get_config()
	{
	//	chargement du fichier de config
		if (is_file(self::ini_file))
		{
			require(self::ini_file);
		}
		else
		{
			return false;
		}
	//	vérification des paramètres
		if (!isset($admin) || !isset($site)) self::error('no-param');
	//	root
		$this->relative_root = (isset($directory)) ? $directory : null;
		$this->domain .= (isset($directory)) ? $directory : null;
		$this->root = (isset($root)) ? $root : $_SERVER['DOCUMENT_ROOT'].$this->relative_root;
	//	recherche du site actif
		foreach ($site as $param)
		{
			foreach ((array) $param['url'] as $version => $url)
			{
			//	recherche exacte
				if (mb_strpos($this->url.'/', $url.'/') === 0)
				{
					$param['url'] = $url;
					$this->site = $param;
					break 2;
				}
			}
			foreach ((array) $param['url'] as $version => $url)
			{
			//	recherche exacte
				if (mb_strpos($url, $this->domain) === 0 && mb_strpos($this->url.'/', mb_substr($url, 0, mb_strrpos($url, '/')).'/') === 0)
				{
					$param['url'] = mb_substr($url, 0, mb_strrpos($url, '/'));
					$this->site = $param;
					break 2;
				}
			}
		}
	//	version
		$this->site['version'] = ($version !== 0) ? $version : null;

		$this->admin = $admin;
		$this->admin['root'] = $this->root.'/'.self::admin_dir;
		if (is_array($this->site))
		{
		//	site
			$this->site['urlr'] = mb_substr($this->url, mb_strlen($this->site['url']));
			$this->site['root'] = $this->root.'/'.self::site_dir.'/'.$this->site['key'];
			// $this->site['theme_root'] = $this->site['root'].self::site_theme_dir;
			// $this->site['theme_relative_root'] = $this->relative_root.self::site_dir.'/'.$this->site['key'].self::site_theme_dir;
			// $this->site['cache_root'] = $this->site['root'].self::site_cache_dir;
		//	admin
			$this->admin['url'] = $this->site['url'].'/'.$this->admin['key'];
			$this->admin['urlr'] = mb_substr($this->url, mb_strlen($this->admin['url']));
			// $this->admin['app_root'] = $this->admin['root'].self::app_dir;
			// $this->admin['app_relative_root'] = $this->relative_root.self::admin_dir.self::app_dir;
			// $this->admin['theme_root'] = $this->admin['root'].self::admin_theme_dir;
			// $this->admin['theme_relative_root'] = $this->relative_root.self::admin_dir.self::admin_theme_dir;
			// $this->admin['cache_root'] = $this->admin['root'].self::admin_cache_dir;
		//	env
			$this->env = (mb_strpos($this->site['urlr'].'/', '/'.$this->admin['key'].'/') === 0) ? 'admin' : 'site';
			if ($this->env === 'site') unset($this->admin['urlr']);
		}
		return true;
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	private function define_config()
	{
		$this->define('admin', $this->admin);
		$this->define('DOCUMENT_ROOT', $this->root);
		$this->core_root = ADMIN_ROOT.'/'.$this->boot;
		// define('CC_ROOT', $this->root);
		// define('CC_DIR', $this->relative_root);
		define('env', $this->env);
		define('ENV', mb_strtoupper($this->env));
		if (!empty($this->site))
		{
			$this->define('site', $this->site);
			$this->define('KEY', constant(ENV.'_KEY'));
			$this->define('URLR', constant(ENV.'_URLR'));
		}
		$this->define('URI', $this->uri);
		$this->define('URL', $this->url);
		$this->define('DOMAIN_URL', $this->domain);
		$this->define('ROOT', constant(ENV.'_ROOT'));
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	private function get_url($domain = false)
	{
		$uri = (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') ? 'http' : 'https';
		$uri .= '://'.$_SERVER['SERVER_NAME'];
		$uri .= ($_SERVER['SERVER_PORT'] == '80' || $_SERVER['SERVER_PORT'] == '443') ? null : ':'.$_SERVER['SERVER_PORT'];
		$this->domain = $uri;
		$uri .= $_SERVER['REQUEST_URI'];
		if (mb_substr($uri, -1) == '/') $uri = mb_substr($uri, 0, -1);
		$this->uri = $uri;
		$this->url = (!mb_strstr($this->uri, '?')) ? $this->uri : mb_substr($this->uri, 0, mb_strpos($this->uri, '?'));
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public static function get($app_root, $require = true)
	{
		$ini_file = $app_root.'/'.self::app_ini_file;

		if (is_file($ini_file) && $ini = parse_ini_file($ini_file, true))
		{
			foreach ($ini[self::app_system_dir] as $type => $files)
			{
				if (in_array($type, array('class', 'lib')))
				{
					foreach ($files as $file)
					{
						$root = $app_root.'/'.self::app_system_dir.'/'.trim($file, '/');
						self::load($root);
					}
				}
			}
		}
		else
		{
			self::error('no-ini', $ini_file);
		}
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	private static function load($file)
	{
		if (is_file($file))
		{
		    require_once $file;
		}
		else self::error('no-file', $file);
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	private function define($name, $value)
	{
		foreach ((array) $value as $key => $data)
		{
			if (is_array($data)) self::define($name.'_'.$key, $data);
			else
			{
				$key = ($key === 0) ? $name : mb_strtoupper($name.'_'.$key);
				if (!defined($key))
				{
					define($key, $data);
				}
			}
		}
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	private function autoload($name)
	{
		(class_exists('registry', false) && $app = registry::get(registry::class_index, $name)) ? self::get(ADMIN_ROOT.'/'.$app) : self::error('no-class', $name);
	}

/**
 * What is this method about
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	private static function error($key, $value = null)
	{
		$param['function'] = __METHOD__;
		$param['error'] = $key;
		switch ($key)
		{
			case 'no-boot':
				$param['What went wrong ?'] = 'Can\'t find <strong>'.self::ini_file.'</strong> file.';
				break;
			case 'no-param':
				$param['What went wrong ?'] = 'Votre fichier de <strong>'.self::ini_file.'</strong> est incomplet. Certains paramètres sont manquants.';
				break;
			case 'no-config':
				$param['What went wrong ?'] = 'Désolé, je ne trouve pas votre site dans le fichier de config';
				break;
			case 'no-ini':
				$param['What went wrong ?'] = 'Sorry, can\'t find ini file : <strong>'.$value.'</strong>';
				break;
			case 'no-file':
				$param['What went wrong ?'] = 'Sorry, file <strong>'.$value.'</strong> is missing.';
				break;
			case 'no-class':
				$param['What went wrong ?'] = 'Sorry, class <strong>'.$value.'</strong> not found.';
				break;

		}
		(class_exists('sentinel', false)) ? sentinel::log(E_ERROR, $param) : die($param['What went wrong ?']);
	}
}
#********************************************************************************************#
/**	* Chargement de l'environnement
*/#******************************************************************************************#
	new boot();
?>
