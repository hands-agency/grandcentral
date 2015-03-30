<?php
/**
 * Get count from database using parameters
 * 
 * Example usage:
 * <pre>
 * $param = array(
 * 	'key' => 'home%',
 * 	'type' => array('html', 'ajax'),
 * 	'section' => array(2, 4),
 * 	'tag' => 1,
 * 	'limit()' => 10 
 * );
 * $count = count::get('page', $param);
 * </pre>
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class count
{
/**
 * Disabled constructor. Use count::get to instanciate
 * 
 * @access	private
 */
	private function __construct() {}
/**
 * Get count from database using parameters
 * 
 * Example:
 * <pre>
 * $bunch->get('page', array(
 * 	'key' => 'home%',
 * 	'type' => array('html', 'ajax'),
 * 	'section' => array(2, 4),
 * 	'tag' => 1,
 * 	'limit()' => 10 
 * );
 * </pre>
 * @param	string  item's name
 * @param	array  	the array of parameters
 * @param	string 	environnement (default current)
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