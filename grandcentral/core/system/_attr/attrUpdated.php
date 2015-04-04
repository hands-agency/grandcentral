<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrUpdated extends attrDate
{
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_get()
	{
		$this->set(date('Y-m-d H:i:s'));
		
		return $this->get();
	}
/**
 * Default field attributes for updated	
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
		$params['key']['value'] = 'updated';
		$params['key']['readonly'] = true;
		unset($params['required'], $params['format']);
	//	Return
		return $params;
	}
}
?>