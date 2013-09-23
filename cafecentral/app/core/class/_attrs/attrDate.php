<?php
/**
 * Date formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrDate
{
/**
 * Force date format
 *
 * @param	string  la date
 * @return	string 	la date formatée
 * @access	public
 * @static
 */
	public static function get($value)
	{
		return $value;
	}

/**
 * Force date format
 *
 * @param	string  la date
 * @return	string 	la date formatée
 * @access	public
 * @static
 */
	public static function set($value)
	{
		return $value;
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
		if (!isset($attr['format']) || empty($attr['format'])) $attr['format'] = 'datetime';
	//	definition
		$definition = '`'.$attr['key'].'` '.$attr['format'].' NOT NULL';
	//	retour
		return $definition;
	}
}
?>