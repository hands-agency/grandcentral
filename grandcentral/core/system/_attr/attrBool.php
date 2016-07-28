<?php
/**
 * Boolean attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrBool extends _attrs
{
/**
 * Set boolean attribute
 *
 * @param	mixed	attribute data (true or false)
 * @access	public
 */
	public function set($data)
	{
		$this->data = (bool) $data;
		return $this;
	}
/**
 * Get the raw data for write in bdd
 *
 * @return	mixed	attribute data
 * @access	public
 */
	public function database_get()
	{
		return (empty($this->data)) ? 0 : $this->get();
	}
/**
 * Display the attribute data
 *
 * @return	string	"true" or "false" string
 * @access	public
 */
	public function __toString()
	{
		return ($this->data === true) ? 'true' : 'false';
	}
/**
 * Get mysql attribute definition
 *
 * @return	string	a mysql string
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` tinyint(1) NOT NULL';
	//	retour
		return $definition;
	}

/**
 * Default field attributes for all fields
 *
 * @return	array	an array of attribute properties
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		# $params['somefield'] = array();
		# unset($param['somefield'])
	//	Return
		return $params;
	}
}
?>
