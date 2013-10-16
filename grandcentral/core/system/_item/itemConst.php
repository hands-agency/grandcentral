<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemConst extends _items
{
/**
 * Fill the object with all his attributes
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function database_set($data)
	{
		parent::database_set($data);
		$this->define();
	}
/**
 * Define a constant from key and title attribute
 *
 * @access  public
 */
	public function define()
	{
		if (!empty($this['key']) && !empty($this['title']) && !defined($this['key']))
		{
			define($this['key'], $this['title']);
		}
	}
}
?>