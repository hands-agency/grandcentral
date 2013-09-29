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
	$p = array(
		'order()' => 'title',
	);
	$structures = cc('structure', $p, $_SESSION['pref']['handled_env']);
	// $s[''] = '...';
	foreach ($structures as $structure)
	{
		$s[$structure['key']] = array(
			'title' => $structure['title'],
			'attr' => $structure['attr'],
			'rel' => $structure['rel']
		);
	}
	echo json_encode($s);
?>
