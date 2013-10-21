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
	public static function get($table, $params, $env = env)
	{
	//	query
		$results = database::query_item($env, $table, $params, true);
	//	return himself
		return $results[0];
	}
}
?>