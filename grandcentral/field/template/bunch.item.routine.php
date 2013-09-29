<?php
/**
 * Routine qui renvoie un JSON de la liste des structures
 * 
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Load the structures
/********************************************************************************************/
	$structure = cc('structure', $_POST['structure'], $_SESSION['pref']['handled_env']);
	$relation = $structure->data['rel'];
	// $items = cc($_POST['table'], all);
	// $s[''] = '...';
	foreach ($items as $item)
	{
		$i[$item->get_nickname()] = $item->get_attr('title');
	}
	echo json_encode($structure);
?>
