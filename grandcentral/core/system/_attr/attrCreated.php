<?php
/**
 * Creation Date attribute handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrCreated extends attrDate
{
/**
 * Transforms the data into mysql date format and autofill with the current date if empty.
 *
 * @return	mixed	attribute data
 * @access	public
 */
	public function database_get()
	{
		if (empty($this->data) or $this->data == '0000-00-00 00:00:00')
		{
			$this->set(date('Y-m-d H:i:s'));
		}
		return $this->get();
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
		$params['key']['value'] = 'created';
		$params['key']['readonly'] = true;
		unset($params['required'], $params['format']);
	//	Return
		return $params;
	}
}
?>