<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrStatus extends _attrs
{
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (string) $data;
		return $this;
	}
/**
 * Set status attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_get()
	{
		if (empty($this->data)) $this->set('live');
		
		return $this->get();
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
	
	
/**
 * Default field attributes for Status	
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		unset($params['required'], $params['title']);
	//	Return
		return $params;
	}
}
?>