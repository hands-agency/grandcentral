<?php
/**
 * Decimal formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrDecimal
{
/**
 * Force decimal format
 *
 * @param	string  la variable décimal
 * @return	string 	la variable formatée
 * @access	public
 * @static
 */
	public static function get($value)
	{
		return $value;
	}

/**
 * Force decimal format
 *
 * @param	string  la variable décimal
 * @return	string 	la variable formatée
 * @access	public
 * @static
 */
	public static function set($value)
	{
		return $value;
	}
/**
 * Definition mysql
 * ex : `salary` decimal(10,2) NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public static function mysql_definition($attr)
	{
		if (empty($attr['max'])) $attr['max'] = 10000000;
		if (empty($attr['round'])) $attr['round'] = 2;
		
	//	definition
		$definition = '`'.$attr['key'].'` decimal('.strlen($attr['max']).','.$attr['round'].') NOT NULL';
	//	retour
		return $definition;
	}
}
?>