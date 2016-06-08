<?php
/**
 * The abstract class for app handling.
 *
 * @package		Core
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
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
	protected $param = array();
	protected static $loaded_file = array();
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	string	the template key starting from the root af the app (ex: master/default)
 * @param	array 	an array of parameters
 * @param	string  environnement
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
 * Gets the app name
 *
 * @return	string	app key string
 * @access	public
 */
	public function get_key()
	{
		return $this->key;
	}
/**
 * Gets the app environnement
 *
 * @return	string	app environnement string (site or admin)
 * @access	public
 */
	public function get_env()
	{
		return $this->env;
	}
/**
 * Gets the root of the app system directory
 *
 * @return	string	root of system directory
 * @access	public
 */
	public function get_systemroot()
	{
		return $this->system_root;
	}
/**
 * Gets the browsable url of the app system directory
 *
 * @return	string	url of the app system directory
 * @access	public
 */
	public function get_systemurl()
	{
		return $this->system_url;
	}
/**
 * Gets the root of the app template directory
 *
 * @param	string	environnement
 * @return	string	root of template directory
 * @access	public
 */
	public function get_templateroot($env = null)
	{
		$env = is_null($env) ? $this->env : $env;
		return $this->template_root[$env];
	}
/**
 * Gets the browsable url of the app template directory
 *
 * @param	string	environnement
 * @return	string	url of template directory
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
 * @param	string  (optional) get a filtered ini (ex : $app->ini('about');)
 * @return	array	config.ini data
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
 * Check for default parameters within the app, and fill $this->param
 *
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
/**
 * Add a array of parameters
 *
 * @param	array	an array of parameters
 * @access	public
 */
	public function set_param($params)
	{
		foreach ((array) $params as $key => $param)
		{
			$this->param[$key] = $param;
		}
	}
/**
 * Gets the app default parameters
 *
 * @param	array	an array of parameters
 * @access	public
 */
	public function get_default_param()
	{
		return isset($this->ini['param']) ? $this->ini['param'] : array();
	}
/**
 * Set a template, a view for the app
 *
 * @param	string	root of the template (ex: master/content)
 * @access	public
 */
	public function set_template($key)
	{
		$this->template = $key;
	}
/**
 * Display the app and handle all dependencies
 *
 * @return	string	data to display
 * @access	public
 */
	public function __tostring()
	{
		try {
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
			(is_file($_TEMPLATE)) ? require($_TEMPLATE) : trigger_error('Sorry. The template <strong>'.$this->template.'.'.$content_type.'.php'.'</strong> in <strong>'.$this->get_templateroot().'</strong> does not exists.', E_USER_WARNING);
			//	on ferme le tampon
			$content = ob_get_contents();
			ob_end_clean();
			//	on affiche
			return $content;
    }
		catch (Exception $exception)
		{
			echo "<pre>";print_r($exception);echo "</pre>";
      return '';
    }
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
 * Get content of a snippet
 *
 * <pre>
 * $_APP->get_snippet('snippet/header', $params)
 * </pre>
 *
 * @param	string	The zone name where you want to bind the snippet (ex: content)
 * @param	string	The relative path to the snippet (ex: master/content)
 * @param	string	Variables you want to use in the snippet
 * @param	bool	Bind the snippet on top of the pile
 * @access	public
 */
	public function get_snippet($snippet_key, $params = null)
	{
	//	Failsafe first slash
		$snippet_key = (mb_strpos($snippet_key, '/') === 0) ? $snippet_key : '/'.$snippet_key;

		$_APP = $this;
		$_PARAM = $params;
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
		return $content;
	}
/**
 * Bind a snippet within the view
 *
 * <pre>
 * $_APP->bind_snippet('content', 'snippet/header')
 * </pre>
 *
 * @param	string	The zone name where you want to bind the snippet (ex: content)
 * @param	string	The relative path to the snippet (ex: master/content)
 * @param	string	Variables you want to use in the snippet
 * @param	bool	Bind the snippet on top of the pile
 * @access	public
 */
	public function bind_snippet($zone, $snippet_key, $params = null, $top = false)
	{
		$content = $this->get_snippet($snippet_key, $params);
		// print'<pre>';print_r(self::$zones);print'</pre>';
		$this->bind_code($zone, $content, $top);
	}
/**
 * Bind a file within the view
 *
 * <pre>
 * $_APP->bind_file('content', 'master/header');
 * </pre>
 *
 * @param	string	the zone name where you want to bind the snippet (ex: content)
 * @param	string	root of the file
 * @param	bool	if true, search for the file in admin directories
 * @access	public
 */
	public function bind_file($zone, $file, $system = false)
	{
		if (filter_var($file, FILTER_VALIDATE_URL) === false)
		{
			//	Failsafe first slash
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
 * Bind a cascading stylesheet within the css zone
 *
 * <pre>
 * $_APP->bind_css('master/css/style.css');
 * </pre>
 *
 * @param	string	root of the css file (ex: master/css/style.css)
 * @param	bool	if true, search for the file in admin directories
 * @access	public
 */
	public function bind_css($file, $system = false)
	{
		$this->bind_file('css', $file, $system);
	}
/**
 * Bind a javscript file within the script zone
 *
 * <pre>
 * $_APP->bind_script('master/js/jquery.js');
 * </pre>
 *
 * @param	string	root of the js file (ex: master/js/jquery.js)
 * @param	bool	if true, search for the file in admin directories
 * @access	public
 */
	public function bind_script($file, $system = false)
	{
		$this->bind_file('script', $file, $system);
	}

/**
 * Bind some code within the given zone
 *
 * <pre>
 * // Bind some jQuery code to the script zone
 * $_APP->bind_code('script', 'console.log("Hi there");');
 * </pre>
 *
 * @param	string	the zone name where you want to bind the code (ex: content)
 * @param	string	the string to bind
 * @param	bool	bind the code on top of the pile
 * @access	public
 */
	public function bind_code($zone, $data, $top = false)
	{
		master::bind_code($zone, $data, $top);
	}
/**
 * Gets the current app parameters
 *
 * @return	array 	an array of parameters
 * @access	public
 */
	public function get_param()
	{
		return $this->param;
	}
/**
 * Gets all the available templates within the app
 *
 * @param	string	template type (html, xml, json...)
 * @param	string	environnement
 * @return	array	an array of template roots
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
							$tpls[] = empty($basename) ? '/'.$matches[1] : $basename.'/'.$matches[1];
							// print'<pre>';print_r('SUCCESS');print'</pre>';
						}
					}
					else
					{
						$base = $basename.'/'.$item->get_key();
						$tmp = $filterFile($item->get_root(), $base);
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
 * Prepare app list and save it into the registry
 *
 * @access	protected
 */
	public static function register()
	{
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
				//	Add slash
					if (mb_strpos($file, '/') !== 0) $file = '/'.$file;
					$libs[] = $app->get_systemroot().$file;
				}
			}
		//	préparation du tableau pour la mise en registre des classes pour l'autoloader
			if (isset($files['class']))
			{
				foreach ($files['class'] as $file)
				{
					preg_match('/([a-z0-9A-Z_-]*).php$/u', $file, $class);
					if (isset($class[1])) $classes[$class[1]] = $app->get_key();
				}
			}
		//	préparation du tableau pour la mise en registre des apps
			$apps[$key] = $app;
		}
	//	mise en registre des apps
		registry::set(registry::app_index, $apps);
	//	mise en registre du nom des classes pour l'autload
		registry::set(registry::class_index, $classes);
	//	chargement des librairies
		foreach ($libs as $file)
		{
			require_once($file);
		}
	}
}
?>
