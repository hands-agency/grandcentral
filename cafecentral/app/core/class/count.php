<?php
/**
 * Get count from database using parameters
 * 
 * Example:
 * $param = array(
 * 	'key' => 'home%',
 * 	'type' => array('html', 'ajax'),
 * 	'section' => array(2, 4),
 * 	'tag' => 1,
 * 	'limit()' => 10 
 * );
 * $count = count::get('page', $param);
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class count
{
/**
 * Constructeur de classe désactivé, utilisez la méthode count::get
 * 
 * @access	private
 */
	private function __construct() {}
/**
 * Get count from database using parameters
 * 
 * Example:
 * $param = array(
 * 	'key' => 'home%',
 * 	'type' => array('html', 'ajax'),
 * 	'section' => array(2, 4),
 * 	'tag' => 1,
 * 	'limit()' => 10 
 * );
 * $bunch->get('page', $param);
 *
 * @param	string  le type d'objet recherché
 * @param	array  	Le tableau de paramètres
 * @param	string 	L'environnement de la recherche, soit "admin" ou "site" (par défaut l'environnement en cours)
 * @access	public
 * @static
 */
	public static function get($table, $param, $env = env)
	{
	//	récupération de la structure de l'objet demandé
		$s = item::create('structure', $table, $env);
	//	analyse des paramètres reçus
		$attr = array();
		$rel = array();
		foreach ((array) $param as $key => $value)
		{
			if ($s->attr_exists($key) || in_array($key, array('order()', 'limit()')))
			{
				$attr[$key] = $value;
			}
			elseif ($s->rel_exists($key))
			{
				$rel[$key] = $value;
			}
		}
	//	version
		if ($s->is_versionable() && !isset($param['version']))
		{
			$v = registry::get(registry::current_index, $env, 'version');
			$rel['version'] = $v['id'];
		}
	//	requête des datas
		$db = database::connect($env);
		$data = $db->querydata($table, $attr, $rel, true);
		return $data['count'];
	}
}
?>