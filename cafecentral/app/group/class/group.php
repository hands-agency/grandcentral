<?php
/**
 * The group item of Café Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class group extends _items
{
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  only site
 * @access	public
 */
	public function __construct($param = null, $env = env)
	{
		$env = 'site';
		parent::__construct($param, $env);
	}
}
?>