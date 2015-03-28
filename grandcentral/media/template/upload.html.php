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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Upload files
/********************************************************************************************/
	if ($_SESSION['user']->is_admin())
	{
	//	Build path
		$path = app('media')->get_templateroot('site').'/';
	//	Add user folder
		if (isset($_POST['folder'])) $path = str_replace('//', '/', $path.$_POST['folder'].'/');
	
	//	Loop through received files
		$return = 'ok';
		foreach($_FILES as $id => $file)
		{
		//	Complete path
			$filePath = $path.$file['name'];
		//	Move file
			if (!move_uploaded_file($file['tmp_name'], $filePath)) $return = 'ko';
		}
	}
	else
	{
		$return = 'ko';
	}
//	Return code
	echo $return;
?>