<?php
/**
 * Event Library
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */

/**
 * When a child adopts a parent
 *
 * @param	string	table
 * @param	mixed	parameter or array of parameters
 * @param	string	admin ou site
 * @return	mixed	an item or a bunch
 * @access	public
 */
/*	function adopt($item)
	{
	//	IOI adoption paper filled !
		if (isset($_POST['adoption']) && !empty($_POST['adoption']))
		{
			list($parent, $parentid) = explode('_', $_POST['adoption']);
		//	Spider cochon (avoid the save() event loop)
			unset($_POST['adoption']);

		//	DEBUG
		//	$debug =  'Parent "'.$parent.'" with id  "'.$parentid.'" adopts this child ("'.$item->get_table().'" with id "'.$item['id'].'")';
		//	sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $debug);

		//	Create family bond
			cc($parent, $parentid)->add_rel('child', $item['id'])->save();
		}
	}
*/
?>