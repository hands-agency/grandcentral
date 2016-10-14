<?php
/**
 * The master class
 *
 * @package		Core
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class master
{
	protected $app;
	protected static $content_type;
//	Storing
	protected static $zones;
	protected static $zoning = false;

/**
 * Create only one instance of the master
 *
 * @return	object	object master
 * @access	protected
 */
	public function __construct(itemPage $page)
	{
	//	zoning
		self::$zoning = $page->get_zoning();
	//	define the master content type
		self::$content_type = (empty($page['type']['content_type'])) ? 'html' : $page['type']['content_type'];
	//	instantiate the app master
		$params = isset($page['type']->get()['master']['param']) ? $page['type']->get()['master']['param'] : array();
		$params['page'] = $page;
		$tpl = (mb_strpos($page['type']['master']['template'], '/') === 0) ? $page['type']['master']['template'] : '/'.$page['type']['master']['template'];
		$this->app = app($page['type']['master']['app'], $tpl, $params, $page->get_env());
	//	retrieve the template root
		$root = $this->app->get_templateroot().$tpl.'.'.$page['type']['content_type'].'.php';
	//	parse the template and parse zones
		self::$zones = self::get_zones($root);
	}
/**
 * Parse a template and extract zones
 *
 * @param	string	root to the tempalte
 * @access	public
 */
	public static function get_zones($root)
	{
	//	on analyse le contenu du template
		$html = (is_file($root)) ? file_get_contents($root) : null;
		$pattern = '/\<!--\s?ZONE\s?:\s?([a-zA-Z0-9_\-|]*)\s?--\>/';
		preg_match_all($pattern, $html, $tmp, PREG_SET_ORDER);
	//	Préparation du tableau de retour
		$zones = array();
		if (!empty($tmp))
		{
			foreach ($tmp as $zone)
			{
				$tmp = explode('|', $zone[1]);
				if (!isset($tmp[1])) $tmp[1] = null;
				$zones[$tmp[0]] = array(
					'key' => $tmp[0],
					'toreplace' => $zone[0],
					'data' => array()
				);
				if (isset($tmp[1])) $zones[$tmp[0]]['float'] = $tmp[1];
				if (isset($tmp[2])) $zones[$tmp[0]]['width'] = $tmp[2];
			}
		}
	//	retour
		return $zones;
	}

/**
 * Get content of a specific zone
 *
 * @param	string	zone key
 * @access	public
 */
	public static function get_zone_data($key)
	{
	//	retour
		return self::$zones[$key];
	}

/**
 * Display the master
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function __tostring()
	{
	//	Load the master content
		$buffer = $this->app->__tostring();
	//	init vars
		$from = $to = array();
	//	fill the master's zones
		foreach (self::$zones as $zone)
		{
			$from[] = $zone['toreplace'];
			$to[] = $this->_prepare_zone($zone);
		}
		$buffer = str_replace($from, $to, $buffer);
	//	display
		return $buffer;
	}
/**
 *
 *
 * @return	string	la clé de l'app
 * @access	protected
 */
	protected function _prepare_zone($zone)
	{
	//	zone avec template
		$key = 'zone/'.$zone['key'];
		$file = $this->app->get_templateroot().$key.'.html.php';
		if (is_file($file))
		{
			$param['zone'] = $zone;
			$app = app('content', $key, $param, $params['page']->get_env());
			$zone = $app->__tostring();
		}
	//	traitement générique d'une zone : concaténation des contenus
		else
		{
			$method = '_prepare_zone_'.$zone['key'];
			if (method_exists($this, $method))
			{
				$html = $this->$method($zone);
			}
			else
			{
				$tmp = null;
				foreach ($zone['data'] as $data)
				{
					$tmp .= self::$zoning && isset($data['id']) ? '<gc-section data-section="'.$data['id'].'">'.$data['data'].'</gc-section>' : $data['data'];
				}
				$html = $tmp;
			}
		}
		return self::$zoning ? '<gc-zone data-zone="'.$zone['key'].'">'.$html.'</gc-zone>' : $html;
	}
/**
 *
 *
 * @return	string	la clé de l'app
 * @access	protected
 */
	protected function _prepare_zone_css($zone)
	{
		$return = null;
		foreach ($zone['data'] as $css)
		{
		//	pour les fichiers css
			if ($css['type'] == 'file')
			{
				if (filter_var($css['url'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED))
				{
					$url = $css['url'];
				}
				else
				{
					$file = new file($css['url']);
				//	url
					$url = (SITE_DEBUG === true) ? $file->get_url(true).'?'.time() : $file->get_url(true);
				}
			//	stylesheet
				$return .= '<link rel="stylesheet" href="'.$url.'"  media="all" type="text/css">';
			}
		//	pour les styles bruts
			else
			{
				$return .= '<style type="text/css" media="all">'.$css['data'].'</style>';
			}
		}
		return $return;
	}
/**
 *
 *
 * @return	string	la clé de l'app
 * @access	protected
 */
	protected function _prepare_zone_script($zone)
	{
		$return = null;
		foreach ($zone['data'] as $script)
		{
		//	pour les fichiers css
			if ($script['type'] == 'file')
			{
				if (filter_var($script['url'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED))
				{
					$url = $script['url'];
				}
				else
				{
					$file = new file($script['url']);
				//	url
					$url = (SITE_DEBUG === true) ? $file->get_url(true).'?'.time() : $file->get_url(true);
				}

			//	stylesheet
				$return .= '<script src="'.$url.'" type="text/javascript" charset="utf-8"></script>';
			}
		//	pour les styles bruts
			else
			{
				$return .= '<script type="text/javascript" charset="utf-8">'.$script['data'].'</script>';
			}
		}
		return $return;
	}
/**
 *
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public static function bind_file($zone, $app, $file)
	{
		if (isset(self::$zones[$zone]))
		{
		//	recherche de versions précédentes
			$valid = true;
			foreach (self::$zones[$zone]['data'] as $value)
			{
				if (isset($value['url']) && $value['url'] == $file)
				{
					$valid = false;
					break;
				}
			}
		//	affectation
			$tmp = array(
				'type' => 'file',
				'url' => $file,
				'app' => $app
			);

			if ($valid) self::$zones[$zone]['data'][] = $tmp;
		}
		else
		{
			trigger_error('Zone <strong>'.$zone.'</strong> does not exists in the master. Try another one.', E_USER_WARNING);
		}
	}

	public static function vide_bind($zone)
	{
		self::$zones[$zone]['data'] = array();
	}
	public static function clean_bind($zone)
	{
		self::$zones[$zone]['data'] = array();
	}


/**
 *
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public static function bind_code($zone, $code, $top = false, $id = null)
	{
		if (isset(self::$zones[$zone]))
		{
			$tmp = array(
				'type' => 'code',
				'data' => $code
			);
			if (!is_null($id)) $tmp['id'] = $id;
			if ($top === false)
			{
				self::$zones[$zone]['data'][] = $tmp;
			}
			else
			{
				array_unshift(self::$zones[$zone]['data'], $tmp);
			}

		}
		else
		{
			trigger_error('Zone <strong>'.$zone.'</strong> does not exists in the master. Try another one.', E_USER_WARNING);
		}
	}
/**
 *
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public static function get_content_type()
	{
		return self::$content_type;
	}

}
?>
