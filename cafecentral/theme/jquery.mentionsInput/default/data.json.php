<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
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
//	Fetch data
/********************************************************************************************/
	$users = cc('human', all, 'site');
//	Create the table
	foreach ($users as $user)
	{
		$json[] = array(
			'id' => $user['id'],
	        'name' => $user['title'],
	        'avatar' => 'http://cdn0.4dots.com/i/customavatars/avatar7112_1.gif',
	        'type' => $user->get_table(),
		);
	}
//	Jsonify
	$json = json_encode($json);
	echo $json;
?>