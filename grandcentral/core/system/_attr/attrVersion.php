<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrVersion extends _attrs
{
/**
 * Set attribute
 *
 * @param	stringd	la variable
 * @return	string	une string
 * @access	public
 */
	public function unfold()
	{
		$v = cc('version', $this->data);
		return $v;
	}
/**
 * Set attribute
 *
 * @param	stringd	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (int) $data;
		return $this;
	}
/**
 * Get attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_get()
	{
		if (empty($this->data))
		{
			$this->data = cc($this->item->get_env(), current)['version']->get();
		}
		return $this->data;
	}
/**
 * Definition mysqld
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` mediumint(3) unsigned NOT NULL';
	//	retour
		return $definition;
	}
/**
 * Definition index mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_index_definition()
	{
	//	definition
		$definition = 'KEY `'.$this->params['key'].'` (`'.$this->params['key'].'`)';
	//	retour
		return $definition;
	}
/**
 * Default field attributes for Version	
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
		# $params['somefield'] = array();
		$params['key']['value'] = 'version';
		$params['key']['readonly'] = true;
		unset($params['required']);
	//	Return
		return $params;
	}
}
?>