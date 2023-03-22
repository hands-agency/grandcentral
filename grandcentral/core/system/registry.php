<?php
/**
 * The registry.
 * A way to store global data. Lots of useful tools too.
 *
 * <pre>
 * // Get the loaded apps
 *	$apps = registry::get(registry::app_index);
 * // Get the loaded classes
 *	$classes = registry::get(registry::class_index);
 * // Get the loaded constants
 * 	$constants = registry::get_constants();
 * </pre>
 *
 *
 * This class stores data in a global registry so they can be easily accessed through the current script.
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class registry
{
//	const
	const all_index = '__all__';
	const current_index = '__current__';
	const attr_index = '__attribute__';
	const dbtable_index = '__dbtable__';
	const class_index = '__class__';
	const app_index = '__app__';
	const reader_index = '__reader__';
	const legacy_index = '__legacy__';
	const url_index = '__url__';
//	Storing
	protected static $instance;
	protected static $data;
/**
 * Create only one instance of the Registry
 *
 * @return	object	object registry
 * @access	public
 */
	protected function __construct()
	{
		// encoding
		mb_internal_encoding(database::charset);
		// const
		define('current', self::current_index);
		define('all', self::all_index);
		// load apps into registry
		app::register();
		// beurk
		$app_index = registry::get(registry::app_index);
		$class_index = registry::get(registry::class_index);
		// cache
		if (!SITE_DEBUG)
		{
			$cache = app('cache');
			$url = $cache->get_templateroot().'/registry/'.md5(URL);
			$file = new file($url);
			self::$data = unserialize($file->get());
			unset($file);
		}
		// beurk
		registry::set(registry::app_index, $app_index);
		registry::set(registry::class_index, $class_index);
		// load structures into registry
		itemItem::register();
		// load user
		$human = item::create('human', null, 'site');
		$human->guess();
		// prepare version
		itemVersion::register();
		// prepare pages
		itemPage::register();
		// prepare environment
		$this->_prepare_current();
		//	constants
		i('const', all, env);

		if (!SITE_DEBUG)
		{
			$current = i('page',current);
			if (isset($current['key']) && is_a($current['key'], 'attrKey') && $current['key']->get() != 'error_404')
			{
				$cache = app('cache');
				$url = $cache->get_templateroot().'/registry/'.md5(URL);
				$file = new file($url);
				$file->set(serialize(self::$data));
				$file->save(true);
			}
		}
	}
/**
 * Create only one instance of the Registry
 *
 * @return	object	object registry
 * @access	public
 */
	public static function getInstance()
	{
		if(is_null(self::$instance))
		{
			self::$instance = new registry();
		}
		return self::$instance;
	}
/**
 * Set something in the registry
 *
 * $types = array('type1', 'type2', 'type3');
 * registry::set('admin', 'type', $types);
 *
 * @param	mixed	la valeur à inscrire dans le registre. Vous pouvez mettre autant d'arguments que vous le souhaitez
 * @access	public
 */
	public static function set()
	{
		$path_el = func_get_args();
		$value = end($path_el);
		array_pop($path_el);
		$count = count($path_el);

        $arr_ref =& self::$data;

        for($i = 0; $i < $count; $i++)
        {
            $arr_ref =& $arr_ref[$path_el[$i]];
        }

        $arr_ref = $value;
	}

/**
 * Get something from the registry
 *
 * registry::get('admin', 'type');
 *
 * @param	mixed	la valeur à lire dans le registre. Vous pouvez mettre autant d'arguments que vous le souhaitez.
 * @access	public
 */
	public static function get()
	{
		$indexes = func_get_args();
		$return = self::$data;
		foreach ($indexes as $index)
		{
			if (is_array($return) && isset($return[$index]))
			{
				$return = $return[$index];
			}
			else
			{
				$return = false;
				break;
			}
		}
		return $return;
	}
/**
 * Get the list of constants stored in the registry
 *
 * @param	string  le type des constantes. Null par défaut.
 * @return	array	le tableau contenant la liste des constantes CC triées par nom
 * @access	public
 */
	public static function get_constants($type=null)
	{
		$constants = get_defined_constants(true);
		$keys = array_keys($constants['user']);
		natcasesort($keys);
		foreach ($keys as $value)
		{
			$index = (mb_strstr($value, '_')) ? substr($value, 0, mb_strpos($value, '_')) : '0';
			$tmp[$index][$value] = $constants['user'][$value];
		}
		return ($type !== null && $tmp[strtoupper($type)]) ? $tmp[strtoupper($type)] : $tmp;
	}
/**
 * Load the current environnement
 *
 * @access	protected
 */
	protected function _prepare_current()
	{
		//	Env
		if (!isset($_SESSION['pref']['handled_env'])) $_SESSION['pref']['handled_env'] = 'site';
		if (isset($_GET['env'])) $_SESSION['pref']['handled_env'] = $_GET['env'];
		// not cached
		if (!registry::get(registry::current_index))
		{
			//	admin
			$admin = item::create('site', 'admin', 'admin');
			$tmp = item::create('version', null, 'admin');
			$v['admin'] = $tmp->guess();
			$admin['version'] = $v['admin'];
			$datas['admin'] = $admin;
			//	site
			$site = item::create('site', SITE_KEY, 'site');
			$tmp = item::create('version', null, 'site');
			$v['site'] = $tmp->guess();
			$site['version'] = $v['site'];
			$datas['site'] = $site;
			//	version
			$datas['version'] = $datas[env]['version'];
			// registre
			self::set(self::current_index, $datas);
			//	page
			$page = item::create('page');
			$page->guess();
			self::set(self::current_index, 'page', $page);
		}
	}
/**
 * Get all the classes or filter it with a prefix
 *
 * @param	string	(optionnal) class prefix
 * @access	public
 */
	public static function get_class($prefix = null)
	{
		$classes = array_keys(self::get(self::class_index));

		if (!is_null($prefix))
		{
			$tmp = array();
			foreach ($classes as $class)
			{
				if (mb_substr($class, 0, mb_strlen($prefix)) == $prefix)
				{
					$tmp[] = $class;
				}
			}
			$classes = $tmp;
		}
		asort($classes);
		return $classes;
	}
}
?>
