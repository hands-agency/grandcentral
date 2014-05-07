<?php
/**
 * App handling
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
abstract class _apps
{
	protected $env;
	protected $key;
	protected $system_root;
	protected $system_url;
	protected $template_root;
	protected $template_url;
	protected $template;
	protected $ini;
	protected $param;
	protected static $loaded_file = array();
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  only site
 * @access	public
 */
	public function __construct($template = 'default', $params = null, $env = env)
	{
		$this->key = mb_substr(mb_strtolower(get_called_class()), 3);
		
		// $this->key = (!empty($key)) ? $key : trigger_error('Your <strong>$key param</strong> is empty, app() will not work', E_USER_WARNING);
		$this->template = (mb_strpos($template, '/') === 0) ? $template : '/'.$template;
		$this->env = $env;
		
		$this->system_root = ADMIN_ROOT.'/'.$this->key.'/'.boot::app_system_dir;
		$this->system_url = '/'.boot::admin_dir.'/'.$this->key.'/'.boot::app_system_dir;
		
		$this->template_root['admin'] = ADMIN_ROOT.'/'.$this->key.'/'.boot::app_template_dir;
		$this->template_root['site'] = SITE_ROOT.'/'.$this->key;
		
		$this->template_url['admin'] = '/'.boot::admin_dir.'/'.$this->key.'/'.boot::app_template_dir;
		$this->template_url['site'] = '/'.boot::site_dir.'/'.SITE_KEY.'/'.$this->key;
		
		$this->get_ini();
		$this->set_default_param();
		$this->set_param($params);
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function get_key()
	{
		return $this->key;
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function get_env()
	{
		return $this->env;
	}
/**
 * Gets the root of the app
 *
 * @return	string	le chemin de l'app
 * @access	public
 */
	public function get_systemroot()
	{
		return $this->system_root;
	}
/**
 * Gets the root of the app
 *
 * @return	string	le chemin de l'app
 * @access	public
 */
	public function get_systemurl()
	{
		return $this->system_url;
	}
/**
 * Gets the root of the app
 *
 * @return	string	le chemin de l'app
 * @access	public
 */
	public function get_templateroot($env = null)
	{
		$env = is_null($env) ? $this->env : $env;
		return $this->template_root[$env];
	}
/**
 * Gets the root of the app
 *
 * @return	string	le chemin de l'app
 * @access	public
 */
	public function get_templateurl($env = null)
	{
		$env = is_null($env) ? $this->env : $env;
		return $this->template_url[$env];
	}
/**
 * Get the .ini file of the app or a part of it
 *
 * @param	string  l'index d'une partie de la configuration (ex : $app->ini('about');)
 * @return	array	la configuration demandée
 * @access	public
 */
	public function get_ini($cat = null)
	{
		if (empty($this->ini))
		{
			$file = ADMIN_ROOT.'/'.$this->key.'/'.boot::app_ini_file;
			$this->ini = (file_exists($file)) ? parse_ini_file($file, true) : trigger_error('Can\'t find <strong>"'.$this->get_key().'" app</strong> config.ini file.', E_USER_ERROR);
		}
		
		return (!is_null($cat) && isset($this->ini[$cat])) ? $this->ini[$cat] : $this->ini;
	}
/**
 * Get the .ini file of the app or a part of it
 *
 * @param	string  l'index d'une partie de la configuration (ex : $app->ini('about');)
 * @return	array	la configuration demandée
 * @access	public
 */
	public function set_default_param()
	{
		if (isset($this->ini['param']))
		{
			foreach ($this->ini['param'] as $key => $param)
			{
				$pattern = '/\[(.*)\]/';
				preg_match($pattern, $param, $value);
				// print'<pre>';print_r($value);print'</pre>';
				$this->param[$key] = (empty($value)) ? $param : $value[1];
				
				switch (true)
				{
					case in_array($this->param[$key], array('true', 'false')):
						$this->param[$key] = (bool) $this->param[$key];
						break;
					case is_numeric($this->param[$key]):
						$this->param[$key] = (int) $this->param[$key];
						break;
				}
			}
		}
	}
	
	public function set_param($params)
	{
		foreach ((array) $params as $key => $param)
		{
			$this->param[$key] = $param;
		}
	}
	
	public function set_template($key)
	{
		$this->template = $key;
	}
/**
 * Afficher l'app
 *
 * @return	string	le code html
 * @access	public
 */
	public function __tostring()
	{
	//	chargement des dépendances
		$this->load();
	//	les quelques variables
		$_APP = &$this;
	//	HACK pour test des fichiers d'initialisation des paramtres de l'app
	//	pour exemple voir le fichier launcher de l'app form
		if (method_exists($this, 'prepare'))
		{
			$this->prepare();
		}
		$_PARAM = &$this->param;
	//	on prépare la vue
		$content_type = master::get_content_type();
		$root = $this->get_templateroot();
		$_ROUTINE = $root.$this->template.'.php';
		$_TEMPLATE = $root.$this->template.'.'.$content_type.'.php';

	//	on ouvre le tampon
		ob_start();
	//	on charge les données à afficher
		if (is_file($_ROUTINE)) include($_ROUTINE);
		(is_file($_TEMPLATE)) ? require($_TEMPLATE) : trigger_error('template <strong>'.$this->template.'.'.$content_type.'.php'.'</strong> in <strong>'.$this->get_templateroot().'</strong> does not exists.', E_USER_WARNING);
	//	on ferme le tampon
		$content = ob_get_contents();
		ob_end_clean();
	//	on affiche
		return $content;
	}
/**
 * Loads app files and dependencies
 *
 * @access	public
 */
	public function load()
	{
	//	chargement des dépendances
		if (isset($this->ini['dependencies']['app']))
		{
			foreach ($this->ini['dependencies']['app'] as $key)
			{
				$app = app($key);
				$app->load();
			}
		}
	//	chargement des scripts
		if (isset($this->ini['system']['script']))
		{
			foreach ($this->ini['system']['script'] as $script)
			{
				$this->bind_file('script', $script, true);
			}
		}
	//	chargement des css
		if (isset($this->ini['system']['css']))
		{
			foreach ($this->ini['system']['css'] as $css)
			{
				$this->bind_file('css', $css, true);
			}
		}
	}
	
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	// public function bind_code($zone, $data)
	// {
	// 	master::bind($zone, $data);
	// }
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_snippet($zone, $snippet_key)
	{
		$_APP = $this;
		// print'<pre>';print_r($data);print'</pre>';
		$routine = $this->get_templateroot().'/'.$snippet_key.'.php';
		$template = $this->get_templateroot().'/'.$snippet_key.'.snippet.php';
	//	on ouvre le tampon
		ob_start();
	//	on charge les données à afficher
		if (is_file($routine)) include($routine);
		(is_file($template)) ? require($template) : trigger_error('Bugger! The snippet file <strong>'.$snippet_key.'.snippet.php</strong> you are calling does not exist.', E_USER_NOTICE);
	//	on ferme le tampon
		$content = ob_get_contents();
		ob_end_clean();
		// print'<pre>';print_r(self::$zones);print'</pre>';
		$this->bind_code($zone, $content);
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_file($zone, $file, $system = false)
	{
		if (filter_var($file, FILTER_VALIDATE_URL) === false)
		{
			$file = (mb_strpos($file, '/') === 0) ? $file : '/'.$file;
			if ($system === false)
			{
				$app = $this->get_templateurl();
				$url = $this->get_templateroot().$file;
			}
			else
			{
				$app = $this->get_systemurl();
				$url = $this->get_systemroot().$file;
			}
		}
		else
		{
			$app = null;
			$url = $file;
		}
		master::bind_file($zone, $app, $url);
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_css($file, $system = false)
	{
		$this->bind_file('css', $file, $system);
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_script($file, $system = false)
	{
		$this->bind_file('script', $file, $system);
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_code($zone, $data)
	{
		master::bind_code($zone, $data);
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function get_param()
	{
		return $this->param;
	}
/**
 * Obtenir la liste des templates de la vue
 *
 * @param	string	le nom du theme
 * @param	string	le type de template (html, routine, json...)
 * @param	string	l'environnement, site ou admin
 * @return	array	le tableau des templates ou false
 * @access	public
 */
	public function get_templates($type = null, $env = null)
	{
		if (!is_null($type))
		{
			$mime = $type;
		}
		else
		{
			$page = item::create('page');
			$mime = array_keys($page->get_authorised_mime());
		}
		$pattern = '/^(.*).('.implode('|', (array) $mime).').php$/';
		// print'<pre>';print_r($pattern);print'</pre>';
	//	recusive function
		$filterFile = function($dirroot, $basename = null) use (&$filterFile, $mime, $pattern)
		{
			$tpls = array();
		//	pattern
			// echo $this->get_key().'<br />';
		//	crawl dir
			$dir = new dir($dirroot);
			if ($dir->exists())
			{
				$dir->get();
				// print'<pre>';print_r($dir);print'</pre>';
				foreach ((array) $dir->data as $item)
				{
					if (is_a($item, 'file'))
					{
						if (preg_match($pattern, $item->get_key(), $matches))
						{
							$tpls[] = empty($basename) ? $matches[1] : $basename.'/'.$matches[1];
							// print'<pre>';print_r('SUCCESS');print'</pre>';
						}
					}
					else
					{
						$tmp = $filterFile($item->get_root(), $item->get_key());
						$tpls = array_merge($tpls, $tmp);
					}
				}
			}
			return $tpls;
		};
	//	call
		$templates = $filterFile($this->get_templateroot($env));
		return (empty($templates)) ? false : $templates;
	}
	
/**
 * Routine de préparation des apps
 *
 * @param	mixed	la valeur à lire dans le registre. Vous pouvez mettre autant d'arguments que vous le souhaitez.
 * @access	protected
 */
	public static function register()
	{
		$cache = new app('cache');
		$fileCache = $cache->get_templateroot().'/registry/'.md5('app');
		//	dans le cache
		if (is_file($fileCache) && filemtime(ADMIN_ROOT) < filemtime($fileCache))
		{
			// print'<pre>';print_r('dans le cache des apps');print'</pre>';
			$datas = unserialize(file_get_contents($fileCache));
		}
		//	création du cache
		else
		{
			//print'<pre>';print_r('génération du cache des apps');print'</pre>';
			$root = new dir(ADMIN_ROOT);
		
			$root->get();
			$classes = array();
		
			foreach ($root as $dir)
			{
				$key = $dir->get_key();
				$app = new app($key);
				$files = $app->get_ini('system');
			//	on charge automatiquement les librairies
				if (isset($files['lib']))
				{
					foreach ($files['lib'] as $file)
					{
						$libs[] = $app->get_systemroot().$file;
					}
				}
			//	préparation du tableau pour la mise en registre des classes pour l'autoloader
				if (isset($files['class']))
				{
					foreach ($files['class'] as $file)
					{
						preg_match('/([a-z0-9A-Z_-]*).php/u', $file, $class);
						if (isset($class[1])) $classes[$class[1]] = $app->get_key();
					}
				}
			//	préparation du tableau pour la mise en registre des apps
				$apps[$key] = $app;
			}
			
			$datas[registry::app_index] = $apps;
			$datas[registry::class_index] = $classes;
			$datas['libraries'] = $libs;
			//	mise en cache
			file_put_contents($fileCache, serialize($datas));
		}
	//	mise en registre des apps
		registry::set(registry::app_index, $datas[registry::app_index]);
	//	mise en registre du nom des classes pour l'autload
		registry::set(registry::class_index, $datas[registry::class_index]);
	//	chargement des librairies
		foreach ($datas['libraries'] as $file)
		{
			require_once($file);
		}
	}
}
?>