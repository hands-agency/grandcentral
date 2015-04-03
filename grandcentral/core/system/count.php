<?php
/**
 * Get a count of items from the database
 * 
 * <pre>
 * // Count the red socks
 * $param = array(
 * 	'color' => 'red',
 * );
 * $count = count::get('socks', $param);
 * </pre>
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class count
{
/**
 * Disabled constructor. Use count::get to instantiate
 * 
 * @access	private
 */
	private function __construct() {}
/**
 * Returns a count of items from database using parameters
 * 
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
 * @param	string  item's name
 * @param	array  	the array of parameters
 * @param	string 	environment (default current)
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