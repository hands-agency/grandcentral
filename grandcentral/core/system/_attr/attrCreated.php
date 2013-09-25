<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrCreated extends attrDate
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
		if (empty($this->data) or $this->data == '0000-00-00 00:00:00')
		{
			$this->set(date('Y-m-d h:i:s'));
		}
		return $this->get();
	}
}
?>