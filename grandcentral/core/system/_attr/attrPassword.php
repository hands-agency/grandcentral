<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrPassword extends _attrs
{
	protected $hash;
	protected $params = array(
		'round' => 10
	);
	
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->hash = password_hash((string) $data, PASSWORD_BCRYPT, array('cost' => $this->params['round']));
		return $this;
	}
/**
 * Get password attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_get()
	{
		return $this->hash;
	}
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_set($data)
	{
		$this->hash = $data;
		return $this;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __toString()
	{
		return 'xxxxxxxx';
	}
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_round($round)
	{
		$this->params['round'] = (int) $round;
		return $this;
	}
/**
 * Is valid password
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function is_valid($data)
	{
		return password_verify($data, $this->hash);
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