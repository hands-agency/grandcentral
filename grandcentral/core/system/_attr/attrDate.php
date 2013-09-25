<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrDate extends _attrs
{
	protected $params = array(
		'type' => 'datetime'
	);
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (empty($data)) ? '0000-00-00 00:00:00' : $data;
		return $this;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function format($format)
	{
		$date = new DateTime($this->data);
		return $date->format($format);
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