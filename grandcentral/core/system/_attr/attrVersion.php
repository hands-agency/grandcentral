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
 * @param	string	la variable
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
	public function get()
	{
		if (empty($this->data)) $this->data = cc('version', current)['id'];
		return $this->data;
	}
}
?>