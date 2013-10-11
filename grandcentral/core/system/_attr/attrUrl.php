<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrUrl extends _attrs
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
 * Get complete item url
 *
 * @return	string	url
 * @access	public
 */
	// public function link($args = null)
	// {
	// 	//	Return
	// 	if (!empty($this->data))
	// 	{
	// 		$arg = null;
	// 	//	Args?
	// 		if (!is_null($arg)) $arg = '?'.http_build_query($arg);
	// 	//	Return
	// 		return constant(mb_strtoupper($this->env).'_URL').$this->get().$arg;
	// 	}
	// 	else return false;
	// }
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __tostring()
	{
		return htmlspecialchars($this->get());
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
		$definition = '`'.$this->params['key'].'` varchar(255) CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
}
?>