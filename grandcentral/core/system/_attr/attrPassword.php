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
	public $hash;
	protected $params = array(
		'round' => 10
	);
/**
 * Get password attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get()
	{
		return null;
	}	
/**
 * Set password attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		if (!empty($data))
		{
			$this->hash = password_hash((string) $data, PASSWORD_BCRYPT, array('cost' => $this->params['round']));
		}
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
	public function is_valid($password)
	{
		return password_verify($password, $this->hash);
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
		$definition = '`'.$this->params['key'].'` varchar(500) CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
}
?>