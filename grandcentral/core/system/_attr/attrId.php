<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrId extends attrInt
{
	protected $id;
	
/**
 * Set id attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get()
	{
		return $this->id;
	}
	
/**
 * Set id attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_set($data)
	{
		$this->id = (int) $data;
		$this->set($data);
		return $this;
	}
	
/**
 * Set id attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function exists()
	{
		return (empty($this->id)) ? false : true;
	}
/**
 * Definition mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` mediumint(3) unsigned NOT NULL AUTO_INCREMENT, PRIMARY KEY (`'.$this->params['key'].'`)';
	//	retour
		return $definition;
	}
}
?>