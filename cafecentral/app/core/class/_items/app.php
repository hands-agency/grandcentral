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
class app extends _items
{
	protected $key;
	protected $root;
	protected $relative_root;
	protected $theme_root;
	protected $ini;
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  only site
 * @access	public
 */
	public function __construct($param = null, $env = env)
	{
		$env = 'admin';
		parent::__construct($param, $env);
	}
/**
 * Format an app by loading the .ini file
 *
 * @param	string  la clé de l'app
 * @param	array 	le tableau de paramètres
 * @access	public
 */	
	public function set_data(_datas $data)
	{
		parent::set_data($data);
		$this->key = $this['key'];
		$this->root = ADMIN_APP_ROOT.'/'.$this['key'];
		$this->relative_root = ADMIN_APP_RELATIVE_ROOT.'/'.$this['key'];
		$this->theme_root = ADMIN_THEME_ROOT.'/'.$this['key'];
		$this->ini();
	}	
/**
 * Gets the key of the app (which is also the folder)
 *
 * @return	string	la clé
 * @access	public
 */
	public function get_key()
	{
		return $this->key;
	}
/**
 * Gets the root of the app
 *
 * @return	string	le chemin de l'app
 * @access	public
 */
	public function get_root()
	{
		return $this->root;
	}
	
/**
 * Gets the relative root of the app
 *
 * @return	string	le chemin de l'app
 * @access	public
 */
	public function get_relative_root()
	{
		return $this->relative_root;
	}
	
/**
 * Get the .ini file of the app or a part of it
 *
 * @param	string  l'index d'une partie de la configuration (ex : $app->ini('about');)
 * @return	array	la configuration demandée
 * @access	public
 */
	public function ini($index = null)
	{
		if (empty($this->ini))
		{
			$file = ADMIN_APP_ROOT.'/'.$this['key'].'/'.boot::app_ini_file;
			$this->ini = (file_exists($file)) ? parse_ini_file($file, true) : $this->delete();
		}
		if (is_null($index)) return $this->ini;
		elseif(isset($this->ini[$index])) return $this->ini[$index];
	}
/**
 * Loads app files and dependencies
 *
 * @access	public
 */
	public function load()
	{
	//	création de la vue
		$view = new html($this);
	//	chargement des scripts liés
		foreach ($this->get_script() as $script)
		{
			$view->bind('script', $script, false);
		}
	//	chargement des css liées
		foreach ($this->get_css() as $css)
		{
			$view->bind('css', $css, false);
		}
	//	chargement des dépendances
		if (!empty($this['dependency']))
		{
			foreach ($this['dependency'] as $appkey)
			{
				cc('app', $appkey)->load();
			}
		}
	}
	
/**
 * Obtenir la liste des thèmes de l'app
 *
 * @param	string	l'environnement, site ou admin
 * @return	array 	la liste des thèmes
 * @access	public
 */
	public function get_themes($env = env)
	{
		$theme_root = ($env == 'site') ? SITE_THEME_ROOT : ADMIN_THEME_ROOT;
		$root = $theme_root.'/'.$this->get_key();
		$dir = new dir($root);
		// print '<pre>';print_r($theme_root);print'</pre>';
		$themes = array();
		if ($dir->exists())
		{
			$dir->get();
			foreach ((array) $dir->data as $theme)
			{
				$themes[] = $theme->get_key();
			}
		}
		
		return $themes;
	}
	
	
/**
 * Obtenir la liste des thèmes de la vue
 *
 * @param	string	le nom du theme
 * @param	string	le type de template (html, routine, json...)
 * @param	string	l'environnement, site ou admin
 * @return	array	le tableau des templates
 * @access	public
 */
	public function get_templates($theme, $viewtype, $env = env)
	{
		$theme_root = ($env == 'site') ? SITE_THEME_ROOT : ADMIN_THEME_ROOT;
		$root = $theme_root.'/'.$this->get_key().'/'.$theme;
		// print '<pre>';print_r($root);print'</pre>';
		$dir = new dir($root);
		$templates = array();
		if ($dir->exists())
		{
			$dir->get();
			$templates = array();
			foreach ((array) $dir->data as $item)
			{
				$key = $item->get_key();
				if (mb_strpos($key, '.'.$viewtype.'.php') !== false)
				{
					$templates[] = mb_substr($key, 0, -mb_strlen('.'.$viewtype.'.php'));
				}
			
			}
		}
		return $templates;
	}
/**
 * retourne dans un tableau les chemins des fichiers javascript trouvé dans le fichier de config
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	charge 
 * @access	private
 */
	public function get_script()
	{
		$scripts = array();
		if (isset($this->ini['script']['file']))
		{
			foreach ($this->ini['script']['file'] as $script)
			{
				$scripts[] = (filter_var($script, FILTER_VALIDATE_URL) === FALSE) ? $script : $script;
			}
		}
		return $scripts;
	}

/**
 * retourne dans un tableau les chemins des fichiers javacss trouvé dans le fichier de config
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	charge 
 * @access	private
 */
	public function get_css()
	{
		$csss = array();
		if (isset($this->ini['css']['file']))
		{
			foreach ($this->ini['css']['file'] as $css)
			{
				$csss[] = (filter_var($css, FILTER_VALIDATE_URL) === FALSE) ? $css : $css;
			}
		}
		return $csss;
	}

/**
 * Validates the app (requirements, dependencies and files)
 *
 * @access	public
 */
	public function validate()
	{
		$this->validate_requirements();
		$this->validate_dependencies();
		$this->validate_files();
	}

/**
 * Validate the app's requirements
 *
 * @access	public
 */
	public function validate_requirements()
	{
	//	IOI requirements specified
		if ($requirements = $this->ini['requirements'])
		{
		//	The requirements
			$_core = registry::get('core');
			$_gd = gd_info();
		//	For easier access
			$conf = array(
				'cc' => $_core['v'],
				'php' => phpversion(),
				'mysql' => null,
				'gd' => $_gd['GD Version'],
			);
			
		//	Check what can be checked
			foreach($requirements as $checking => $needed)
			{
				$installed = $conf[$checking];
				if ($installed && (version_compare($installed, $needed) < 0))
				{
					$e = array(
						'What went wrong' => 'Your <dfn title="'.$installed.'">version of '.$checking.'</dfn> is lower than the <dfn title="'.$needed.'">version of '.$checking.'</dfn> required by the <dfn title="'.$this->root.'">'.$this->key.' app</dfn>.',
						'Try that' => 'Upgrade your version of '.$checking.' or get an older version of this app.',
					);
					sentinel::log(E_WARNING, $e);
				}
			}
		}
	}

/**
 * Validate the app's dependencies
 *
 * @access	public
 */
	public function validate_dependencies()
	{
		if (!empty($this->ini['dependencies']))
		{
		//	Always work with an array
			$this->ini['dependencies']['app'] = (array) $this->ini['dependencies']['app'];
		//	Loop through the scopes
			foreach($this->ini['dependencies']['app'] as $dependency)
			{
				if (!app::exists($dependency))
				{
					$e = array(
						'What went wrong' => 'Damn, did you know? The <dfn>'.$this->key.' app</dfn> you\'re calling requiers <dfn>the '.$dependency.' app</dfn> to be installed and it\'s not...',
						'Try that' => 'Get <dfn>the '.$dependency.' app</dfn>, an all will be fine!',
					);
					sentinel::log(E_WARNING, $e);
				}
			}
		}
	}

/**
 * Validates the app's files
 *
 * @access	public
 */
	public function validate_files()
	{	
	//	IOI files have been declared
		if ($file = $this->ini['files'])
		{
		//	Check if all the files exist
			foreach($file as $key => $type)
			{
				for ($i=0; $i < count($type); $i++)
				{
					$file = $this->root.$type[$i];

				//	The file has to exists
					if (!file_exists($file))
					{
					//	Say it's not valid
						$e = array(
							'What went wrong' => 'The '.$key.' <dfn title="'.$file.'">'.$type[$i].'</dfn> declared in the <dfn title="'.$this->ini.'">config file</dfn> of the <dfn title="'.$this->root.'">'.$this->key.' app</dfn> does not exist.',
							'Try that' => 'Edit the <dfn title="'.$this->ini.'">config file</dfn> to remove the call or create that <dfn title="'.$file.'">file</dfn>.',
						);
						sentinel::log(E_WARNING, $e);
					}
				}
			}
		}
	}

/**
 * Throw errors
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	private function error($key, $value = null)
	{
		$param['function'] = 'error::'.$this->key;
		switch ($key)
		{
			case 'no-ini':
				$param['What went wrong ?'] = 'Can\'t find <strong>'.$value.'</strong> file.';
				break;
		}
		sentinel::log(E_WARNING, $param);
	}
}
?>