<?php
/**
 * App handling
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class version extends _items
{
	
/**
 * Chargement automatique des versions
 *
 * @access	public
 */	
	public function guess()
	{
		$param = array('default' => true);
		if ($this->get_env() == 'site' && SITE_VERSION != null)
		{
			$param = SITE_VERSION;
		}
		$this->get($param);
	}
}
?>