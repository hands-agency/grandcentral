<?php
/**
 * Boolean formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrBool
{
/**
 * Type la variable en bool
 *
 * @param	mixed	la variable à typer
 * @return	bool 	boolean
 * @access	public
 * @static
 */
	public static function get($value)
	{
		return (bool) $value;
	}

/**
 * Type la variable en bool
 *
 * @param	mixed	la variable à typer
 * @return	bool 	boolean
 * @access	public
 * @static
 */
	public static function set($value)
	{
		return (bool) $value;
	}
/**
 * Definition mysql
 * ex : `datetimeinsert` datetime NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public static function mysql_definition($attr)
	{
	//	definition
		$definition = '`'.$attr['key'].'` tinyint(1) NOT NULL';
	//	retour
		return $definition;
	}
}
?>