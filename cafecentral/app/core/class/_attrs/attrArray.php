<?php
/**
 * Array formated attributes handling class
 *
 * Encodes and decodes the json formated attributes
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrArray
{
/**
 * Decode the JSON array
 *
 * @param	string  la string en json
 * @return	array 	la string décodée
 * @access	public
 * @static
 */
	public static function get($value)
	{
		return json_decode($value, true);
	}

/**
 * Encode into JSON for storage
 *
 * @param	array 	le tableau
 * @return	string	la string encodée
 * @access	public
 * @static
 */
	public static function set($value)
	{
		return (empty($value)) ? null : json_encode($value);
	}
/**
 * Definition mysql
 * ex : `param` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public static function mysql_definition($attr)
	{
	//	definition
		$definition = '`'.$attr['key'].'` mediumtext CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
}
?>