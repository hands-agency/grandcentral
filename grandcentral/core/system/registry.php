<?php
/**
 * The registry.
 *
 * This class stores data in a global registry so they can be easily accessed through the current script.
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
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
	//	encoding
		mb_internal_encoding(database::charset);
	//	const
		define('current', self::current_index);
		define('all', self::all_index);
	//	load structures into registry
		$this->_prepare_structure();
	//	load apps into registry
		$this->_prepare_app();
	//	load page readers into registry
		$this->_prepare_reader();
	//	prepare environment
		$this->_prepare_current();
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
 * On charge toutes les structures disponibles et on crée la liste de définition des attributs
 *
 * @param	mixed	la valeur à lire dans le registre. Vous pouvez mettre autant d'arguments que vous le souhaitez.
 * @access	protected
 */
	protected function _prepare_structure()
	{
		
	//	pour les deux environnements
		foreach (array('admin', 'site') as $env)
		{
			$db = database::connect($env);
		//	on cherche les structures disponibles et on les mets dans le registre
			$results = $db->query('SELECT * FROM structure ORDER BY `key`');
			
			foreach ($results['data'] as $result)
			{
				$result['attr'] = json_decode($result['attr'], true);
				self::set($env, self::attr_index, $result['key'], $result);
				self::set($env, self::attr_index, 'structure_'.$result['id'], $result['key']);
			}
		}
	}
/**
 * Création de la liste des classes de l'application (pour l'autoload)
 *
 * @param	mixed	la valeur à lire dans le registre. Vous pouvez mettre autant d'arguments que vous le souhaitez.
 * @access	protected
 */
	protected function _prepare_app()
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
					require_once($app->get_systemroot().'/'.$file);
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
	//	mise en registre des apps
		self::set(self::app_index, $apps);
	//	mise en registre du nom des classes pour l'autload
		self::set(self::class_index, $classes);
	}
/**
 * Chargement du site, du user, des versions et de la page courrants
 *
 * @access	protected
 */
	protected function _prepare_current()
	{
	//	user
		$human = item::create('human', null, 'site');
		$human->guess();
	//	Env
		if (!isset($_SESSION['pref']['handled_env'])) $_SESSION['pref']['handled_env'] = 'site';
		if (isset($_GET['env'])) $_SESSION['pref']['handled_env'] = $_GET['env'];
	//	admin
		$admin = item::create('site', 'admin', 'admin');
		self::set(self::current_index, 'admin', $admin);
	//	site
		$site = item::create('site', SITE_KEY, 'site');
		self::set(self::current_index, 'site', $site);
	//	version
		$version = item::create('version');
		$version->guess();
		self::set(self::current_index, 'version', $version);
	//	page
		$page = item::create('page');
		$page->guess();
		self::set(self::current_index, 'page', $page);
	//	constants
		cc('const', all);
	}
/**
 * Obtenir les classes disponibles
 *
 * @param	string	préfixe des classes recherchées
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
		
		return $classes;
	}
/**
 * On charge toutes les url et les types de pages
 *
 * @access	protected
 */
	protected function _prepare_reader()
	{
		$db = database::connect('site');
		$q = 'SELECT `id`, `url`, `type` FROM `page` WHERE `type` LIKE "%\"item\":%"';
		$r = $db->query($q);
		
		foreach ($r['data'] as $reader)
		{
			$reader['type'] = json_decode($reader['type'], true);
			self::set(self::reader_index, $reader['type']['item'], $reader);
		}
	}
}
?>