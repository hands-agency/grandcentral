<?php
/**
 * The master class
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class master
{
	protected $app;
	protected static $content_type;
//	Storing
	protected static $zones;
	
/**
 * Create only one instance of the master
 *
 * @return	object	object master
 * @access	protected
 */
	public function __construct(itemPage $page)
	{
	//	define the master content type
		self::$content_type = (empty($page['type']['content_type'])) ? 'html' : $page['type']['content_type'];
	//	instanciate the app master
		$params['page'] = $page;
		$this->app = new app('master', $page['type']['master'], $params);
	//	retreive the template root
		$root = $this->app->get_templateroot().$page['type']['master'].'.'.$page['type']['content_type'].'.php';
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
					'float' => $tmp[1],
					'toreplace' => $zone[0],
					'data' => null
				);
			}
		}
	//	retour
		return $zones;
	}
	
/**
 * Display the master
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function __tostring()
	{
	//	buffering
		$buffer = $this->app->__tostring();
		
		$from = $to = array();
	//	fill the master's zones
		foreach (self::$zones as $zone)
		{
			$from[] = $zone['toreplace'];
			$to[] = $zone['data'];
		}
		$buffer = str_replace($from, $to, $buffer);
	//	display
		return $buffer;
	}

/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public static function bind($zone, $data)
	{
		if (isset(self::$zones[$zone]))
		{
			self::$zones[$zone]['data'] .= $data;
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