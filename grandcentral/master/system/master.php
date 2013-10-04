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
	protected static $instance;
	protected static $zones;
	
/**
 * Create only one instance of the master
 *
 * @return	object	object master
 * @access	protected
 */
	protected function __construct()
	{
	//	get the page to display
		$page = cc('page', current);
	//	Give the page the header
		$page->header();
		// print'<pre>';print_r($page);print'</pre>';
	//	define the master content type
		self::$content_type = (empty($page['master']['type'])) ? 'html' : $page['master']['type'];
	//	instanciate the app master
		$params['page'] = $page;
		$this->app = new app('master', $page['master']['key'], $params);
	//	retreive the template root
		$root = $this->app->get_templateroot().$page['master']['key'].'.'.$page['master']['type'].'.php';
	//	parse the template and parse zones
		self::$zones = self::get_zones($root);
	//	display
		echo $this;
	}
/**
 * Create only one instance of the master
 *
 * @return	object	object master
 * @access	public
 */
	public static function getInstance()
	{
		if(is_null(self::$instance))
		{
			self::$instance = new master();
		}
		return self::$instance;
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
		self::$zones[$zone]['data'] .= $data;
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