<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrString
{
/**
 * Force string format
 *
 * @param	mixed	la variable
 * @return	string	une string
 * @access	public
 * @static
 */
	public static function get($value)
	{
		return (string) $value;
	}
/**
 * Force string format
 *
 * @param	mixed	la variable
 * @return	string	une string
 * @access	public
 * @static
 */
	public static function set($value)
	{
		return (string) $value;
	}
/**
 * Definition mysql
 * ex : `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public static function mysql_definition($attr)
	{
	//	type mysql
		switch ($attr['max'])
		{
			case 0:
				$type = 'varchar(65535)';
				break;
			case $attr['max'] <= 65535:
				$type = 'varchar('.$attr['max'].')';
				break;
			case $attr['max'] > 65535:
				$type = 'mediumtext';
				break;
		}
	//	definition
		$definition = '`'.$attr['key'].'` '.$type.' CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
}
?>