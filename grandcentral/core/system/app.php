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
class app
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
	public static $loaded_file = array();
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  only site
 * @access	public
 */
	public function __construct($key, $template = 'default', $params = null, $env = env)
	{
		$this->key = (!empty($key)) ? $key : trigger_error('Your <strong>$key param</strong> is empty, new app() will not work', E_USER_WARNING);
		$this->template = $template;
		$this->env = $env;
		
		$this->system_root = ADMIN_ROOT.'/'.$key.'/'.boot::app_system_dir.'/';
		$this->system_url = '/'.boot::admin_dir.'/'.$key.'/'.boot::app_system_dir.'/';
		
		$this->template_root['admin'] = ADMIN_ROOT.'/'.$key.'/'.boot::app_template_dir.'/';
		$this->template_root['site'] = SITE_ROOT.'/'.$key.'/';
		
		$this->template_url['admin'] = '/'.boot::admin_dir.'/'.$key.'/'.boot::app_template_dir.'/';
		$this->template_url['site'] = '/'.boot::site_dir.'/'.SITE_KEY.'/'.$key.'/';
		
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
	public function get_templateroot($env = env)
	{
		return $this->template_root[$env];
	}
/**
 * Gets the root of the app
 *
 * @return	string	le chemin de l'app
 * @access	public
 */
	public function get_templateurl($env = env)
	{
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
			$this->ini = (file_exists($file)) ? parse_ini_file($file, true) : trigger_error('Can\'t find <strong>"'.$this->get_key().'" app</strong> config.ini file.', E_USER_WARNING);
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
		$_PARAM = &$this->param;
	//	on prépare la vue
		$content_type = (empty(master::$content_type)) ? 'html' : master::$content_type;
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
				$app = new app($key);
				$app->load();
			}
		}
	//	chargement des scripts
		if (isset($this->ini['system']['script']))
		{
			foreach ($this->ini['system']['script'] as $script)
			{
				$this->bind_script($script, true);
			}
		}
	//	chargement des css
		if (isset($this->ini['system']['css']))
		{
			foreach ($this->ini['system']['css'] as $css)
			{
				$this->bind_css($css, true);
			}
		}
	}
	
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_code($zone, $data)
	{
		master::bind($zone, $data);
	}
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
		$routine = $this->get_templateroot().$snippet_key.'.php';
		$template = $this->get_templateroot().$snippet_key.'.snippet.php';
	//	on ouvre le tampon
		ob_start();
	//	on charge les données à afficher
		if (is_file($routine)) include($routine);
		(is_file($template)) ? require($template) : trigger_error('Snippet <strong>'.$template.'</strong> does not exist.', E_USER_NOTICE);
	//	on ferme le tampon
		$content = ob_get_contents();
		ob_end_clean();
		// print'<pre>';print_r(self::$zones);print'</pre>';
		master::bind($zone, $content);
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_css($file, $system = false)
	{
		$key = $this->get_key().'/'.$file;
		
		if (!in_array($key, self::$loaded_file))
		{
			if ($system === false)
			{
				$url = $this->get_templateurl();
				$root = $this->get_templateroot();
			}
			else
			{
				$url = $this->get_systemurl();
				$root =$this->get_systemroot();
			}
		
			if (!is_file($root.$file)) trigger_error('Css <strong>'.$file.'</strong> does not exist.', E_USER_NOTICE);
			else
			{
				if (SITE_DEBUG === true)
				{
					$refresh = '?'.time();
					$data = '<link rel="stylesheet" href="'.$url.$file.$refresh.'" type="text/css" charset="utf-8">';
				}
				else
				{
		
				}
				master::bind('css', $data);
				self::$loaded_file[] = $key;
			}
		}
		
		
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_script($file, $system = false)
	{
	//	script interne
		if (filter_var($file, FILTER_VALIDATE_URL) === false)
		{
			if ($system === false)
			{
				$urlscript = $this->get_templateurl().$file;
				$rootscript = $this->get_templateroot().$file;
			}
			else
			{
				$urlscript = $this->get_systemurl().$file;
				$rootscript = $this->get_systemroot().$file;
			}
		}
	//	script externe
		else
		{
			$urlscript = $file;
		}
		
		if (!in_array($urlscript, self::$loaded_file))
		{
			if (isset($rootscript) && !is_file($rootscript))
			{
				trigger_error('Script <strong>'.$file.'</strong> does not exist.', E_USER_NOTICE);
			}
			else
			{
				if (SITE_DEBUG === true)
				{
					$refresh = '?'.time();
					$data = '<script src="'.$urlscript.'" type="text/javascript" charset="utf-8"></script>';
				}
				else
				{
		
				}
				master::bind('script', $data);
				self::$loaded_file[] = $urlscript;
			}
		}
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function bind_app($zone, app $app)
	{
		master::bind($zone, $app->__tostring());
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
// 	
// /**
//  * Obtenir la liste des templates de la vue
//  *
//  * @param	string	le nom du theme
//  * @param	string	le type de template (html, routine, json...)
//  * @param	string	l'environnement, site ou admin
//  * @return	array	le tableau des templates
//  * @access	public
//  */
// 	public function get_templates()
// 	{
// 		$root = ($env == 'site') ? SITE_ROOT.'/'.$this->key : ADMIN_ROOT.'/'.$this->key.boot::app_template_dir;
// 		// $root = $theme_root.'/'.$this->key().'/'.$theme;
// 		// print '<pre>';print_r($root);print'</pre>';
// 		$dir = new dir($root);
// 		$templates = array();
// 		if ($dir->exists())
// 		{
// 			$dir->get();
// 			$templates = array();
// 			foreach ((array) $dir->data as $item)
// 			{
// 				$key = $item->get_key();
// 				if (mb_strpos($key, '.'.$viewtype.'.php') !== false)
// 				{
// 					$templates[] = mb_substr($key, 0, -mb_strlen('.'.$viewtype.'.php'));
// 				}
// 			
// 			}
// 		}
// 		return $templates;
// 	}
}
?>