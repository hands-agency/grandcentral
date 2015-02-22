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
 * @author		Michaël V. Dandrieux <mvd@eranos.fr>
 * @copyright	Copyright ©2014 Eranos
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	TEMP
/********************************************************************************************/
	$method = $_SERVER['REQUEST_METHOD'];
	$item = 'human';
	$id = 1;
	$attr = 'pref';
	
/********************************************************************************************/
//	Get to work
/********************************************************************************************/
	switch ($method)
	{
	//	GET
		case 'GET':
			$i = i($item, $id);
			break;
			
	//	POST
		case 'POST':
			$i = i($item);
			foreach ($attrs as $key => $value)
			{
				$i[$key] = $value;
			}
			$i->save();
			break;

	//	PUT
		case 'PUT':
			# code...
			break;

	//	PATCH
		case 'PATCH':
			# code...
			break;
	
	//	DELETE
		case 'DELETE':
			# code...
			break;
	}
	echo $i->json();
?>