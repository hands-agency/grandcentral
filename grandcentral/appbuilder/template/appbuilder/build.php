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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$apps = registry::get(registry::app_index);
	$app = $_POST['app'];
	$path = ADMIN_ROOT.'/'.$app['key'];
	$content = '';
	
/********************************************************************************************/
//	Let's get to work
/********************************************************************************************/
//	Check if this app does not already exist
	if (isset($apps[$app]))
	{
		
	}
	else
	{
	//	Create the folder
		if (!file_exists($path))
		{
			mkdir($path, 0777, true);
			mkdir($path.'/system', 0777, true);
			mkdir($path.'/template', 0777, true);
		}
	//	Create the config.ini
		$file = $path.'/config.ini';
		// Ajoute une personne
		foreach ($app as $key => $value)
		{
			if (isset($value)) $content .= $key." = \"".$value."\"\n";
		}
	//	Add to the file
		file_put_contents($file, $content);
	}

/********************************************************************************************/
//	Return
/********************************************************************************************/
	$return = array(
		'meta' => array
		(
			'msg' => 'success',
			'path' => $path,
		),
	);
	
	echo json_encode($return);
?>