<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemStructure extends _items
{
	protected $key;
	protected $attr;
	
/**
 * Fill the object with all his attributes
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function set_data($data)
	{
		$this->data = $data;
		$this->attr = $data['attr'];
		$this->key = $data['key'];
	}
	

}
?>