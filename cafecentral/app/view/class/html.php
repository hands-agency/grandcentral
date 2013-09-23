<?php
/**
 * La classe de manipulation des vues html
 *
 * @package  views
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class html extends _views
{
	public static $zones = array();
	protected $zone_filename = array('css' => 'page', 'script' => 'script');
	protected $zoning = false;
	protected $key = 'html';
	const content_type = 'text/html';

/**
 * Moteur d'inclusion, remplit les zones et le tampon de sortie
 *
 * @access	protected
 */
	protected function _bufferize()
	{
	//	création des zones html
		$this->_prepare_zone();
	//	parent
		parent::_bufferize();
	//	on postraite le contenu retourné si cela est demandé
		if ($this->zoning === true) $this->content = $this->_set_zone($this->content);
	// //	chargement des dépendances javascript
	// 	$this->app->load_dependencies();
	// //	chargement des bibliothèques javascript
	// 	$scripts = $this->app->get_script();
	// 	// print '<pre>avant bind : ';print_r($scripts);print'</pre>';
	// 	foreach ($scripts as $script)
	// 	{
	// 		$this->bind('script', $script, false);
	// 	}
		// print '<pre>'.$this->theme_key.'/'.$this->template_key.' : ';print_r(html::$zones['script']);print'</pre>';
	//	chargement des dépendances css
		// $csss = $this->app->get_dependencies();
		// //	chargement des css
		// 	$csss = array_merge($csss, $this->app->get_css());
		// 	foreach ($csss as $css)
		// 	{
		// 		$this->bind('css', $css, false);
		// 	}
	}
/**
 * Obtenir la liste des zones d'un template html
 *
 * @param	string	le nom d'une app
 * @param	string	le nom du thème
 * @param	string	le chemin du template
 * @access	public
 */
	public function get_zones()
	{
	//	on charge les chemins
		$this->_prepare();
	//	on analyse le contenu du template
		$html = (is_file($this->view)) ? file_get_contents($this->view) : null;
		$pattern = '/\<!--\s?ZONE\s?:\s?([a-zA-Z0-9_\-|]*)\s?--\>/';
		preg_match_all($pattern, $html, $tmpzones, PREG_SET_ORDER);
	//	Préparation du tableau de retour
		$zones = array();
		if (!empty($tmpzones))
		{
			$this->zoning = true;
			foreach ($tmpzones as $zone)
			{
				$tmp = explode('|', $zone[1]);
				if (!isset($tmp[1])) $tmp[1] = null;
				$zones[$tmp[0]] = array(
					'key' => $tmp[0],
					'float' => $tmp[1],
					'toreplace' => $zone[0]
				);
			}
		}
	//	retour
		return $zones;
	}
/**
 * Parser le contenu du document pour y détecter des zones et leurs propriétés
 *
 * @access	protected
 */
	protected function _prepare_zone()
	{
		foreach ((array) $this->get_zones() as $zone)
		{
			$zone['data'] = null;
			self::$zones[$zone['key']] = $zone;
		}
	//	chargement des composants de l'app dans la vue
		$this->app->load();
	}	
/**
 * Lier des fichiers ou du code à une zone
 *
 * @param	string  la clé de la zone cible
 * @param	string  le nom du fichier à lier ou le code
 * @param	bool	changer le root entre répertoire source app et template
 * @access	public
 */
	public function bind($zone_key, $data, $format_root = true)
	{
		if (isset(self::$zones[$zone_key]))
		{
		//	Bind an object
			if (is_object($data))
			{
				$data = $data->__tostring();
			}
		//	Bind code / file
			else $data = $data;
			
			$class = 'zone_'.$zone_key;
			if ($format_root === false)
			{
				$root = $this->app->get_root();
				$relative_root = $this->app->get_relative_root();
			}
			else
			{
				$root = $this->get_root(true);
				$relative_root = $this->get_root();
			}
			$zone = array(
				'root' => $root,
				'relative_root' => $relative_root,
				'data' => $data
			);
			self::$zones[$zone_key]['data'][] = $zone;
			
		}
		else $this->_error('no-zone', $zone_key);
	}
/**
 * Lier un template à une zone
 *
 * @param	string  la clé de la zone cible
 * @param	string  la clé du template
 * @access	public
 */
	public function bind_template($zone_key, $template)
	{
		$this->app->template_key = $template;
		$view = new $this->key($this->app);
		$view->set_theme($this->theme_key);
		$this->bind($zone_key, $view);
	}
	
/**
 * Lier une app à la vue
 *
 * @param	string  la clé de l'app
 * @access	public
 */
	public function bind_app($app_key)
	{
		cc('app', $app_key, 'admin')->load();
	}
		
/**
 * Compile les données empilées dans le tampon et associe une fonction de traitement à chaque zone
 *
 * @param	array 	le tampon brut de la zone
 * @return	string	le tampon traité
 * @access	protected
 */	
	protected function _set_zone($buffer)
	{
		// print '<pre>';print_r(self::$zones);print'</pre>';
		$from = $to = array();
		$default = '_zone_default';
		foreach (self::$zones as $key => $value)
		{
			$method = '_zone_'.$key;
			$from[] = $value['toreplace'];
			$to[] = (method_exists($this, $method)) ? $this->$method($value) : $this->$default($value);
		}
		$buffer = str_replace($from, $to, $buffer);
	    return $buffer;
	}
/**
 * Traitement par défaut d'une zone
 *
 * @param	array 	le tampon de la zone
 * @return	string	le tampon concaténé
 * @access	protected
 */
	protected function _zone_default($zone)
	{
		$buffer = null;
		foreach ((array) $zone['data'] as $value)
		{
			$buffer .= $value['data'];
		}
		return $buffer;
	}
/**
 * Traitement d'une zone javascript
 *
 * @param	array 	le tampon de la zone
 * @return	string	le tampon traité
 * @access	protected
 */
	protected function _zone_script($zone)
	{
		$file = new file(CACHE_ROOT.'/page_'.cc('page', current)->get_attr('key').'/'.$this->zone_filename['script'].'.js');
		$buffer = null;
		$memory = array();
		foreach ((array) $zone['data'] as $value)
		{
			$root = (filter_var($value['data'], FILTER_VALIDATE_URL) === FALSE) ? $value['root'].$value['data'] : $value['data'];
			if (!in_array($root, $memory))
			{
				$memory[] = $root;
				if (filter_var($value['data'], FILTER_VALIDATE_URL) === FALSE)
				{
					// print '<pre>';print_r($value);print'</pre>';
					(is_file($root)) ? $file->combine_file($root) : $file->combine_string($value['data']);
				}
				else
				{
					$buffer .= '<script src="'.$root.'" charset="utf-8"></script>';
				}
			}
		}
		// print '<pre>';print_r(registry::get_constants());print'</pre>';
		if (!SITE_DEBUG)
		{
			$file->minify('css');
			$refresh = '';
		}
		else
		{
			$refresh = '?'.time();
		}
		$file->save(true);
		$buffer .= '<script src="'.$file->get_url().$refresh.'" charset="utf-8"></script>';
		return $buffer;
	}
/**
 * Traitement d'une zone css
 *
 * @param	array 	le tampon de la zone
 * @return	string	le tampon traité
 * @access	protected
 */
	protected function _zone_css($zone)
	{
		$file = new file(CACHE_ROOT.'/page_'.cc('page', current)->get_attr('key').'/'.$this->zone_filename['css'].'.css');
		$file->delete();
		$memory = array();
		foreach ((array) $zone['data'] as $css)
		{
			
			if (!in_array($css['root'].$css['data'], $memory))
			{
				$memory[] = $css['root'].$css['data'];
				
				$tmp = new file(null);
				$tmp->combine_file($css['root'].$css['data']);
				$data = $tmp->get();
				preg_match_all('/url\([\'"]?([^\'"]*)[\'"]?\)/', $data, $matches);
				$from = $to = array();
				foreach ($matches[1] as $url)
				{
					if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED) && !in_array($url, $from))
					{
						$from[] = $url;
						$to[] = $css['relative_root'].$url;
					}
				}
				$data = str_replace($from, $to, $data);
				$file->combine_string($data);
			}
		}
		
		if (!SITE_DEBUG)
		{
			$file->minify('css');
			$refresh = '';
		}
		else
		{
			$refresh = '?'.time();
		}
		$file->save(true);
		return '<link rel="stylesheet" href="'.$file->get_url().$refresh.'" media="all" charset="utf-8">';
	}
/**
 * Change le nom du fichier crée dans le cache pour une zone donnée
 *
 * @param	string	le nom de la zone
 * @param	string	le nom du fichier de cache
 * @access	public
 */
	public function zone_filename($zone, $name)
	{
		if (isset($this->zone_filename[$zone]))
		{
			$this->zone_filename[$zone] = $name;
		}
		
	}
/**
 * Gestion des erreurs, envoie une sentinelle (à réviser)
 *
 * @param	string  la clé de l'erreur
 * @param	mixed	la valeur responsable de l'erreur
 * @access	protected
 */
	protected function _error($type, $value = null)
	{
		$param = null;
		switch ($type)
		{
			case 'no-zone':
				$param['What went wrong ?'] = 'Sorry, zone '.$value.' do not exists';
				break;
		}
		parent::_error($type, $value);
	}
}
?>