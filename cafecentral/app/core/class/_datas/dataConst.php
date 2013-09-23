<?php
/**
 * Handles data fetched in the database
 *
 * a data = one line in the database
 * 
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class dataConst extends data
{
	public function set_data($data)
	{
		parent::set_data($data);
		if (!empty($this->data['key']) && !empty($this->data['title']) && !defined($this->data['key']))
		{
			define($this->data['key'], $this->data['title']);
		}
	}
}
?>