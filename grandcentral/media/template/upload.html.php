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
 * @copyright	Copyright © 2004-2013, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Upload files
/********************************************************************************************/
//	Build path
	if ($_POST['root'] != '/') $_POST['root'] .= '/'; /* Final slash */
	$path = SITE_ROOT.'/'.$_POST['app'].$_POST['root'];
	
//	Loop through received files
	foreach($_FILES as $id => $file)
	{
	//	Complete path
		$filePath = $path.$file['name'];
	//	Move file
		if (!move_uploaded_file($file['tmp_name'], $filePath)) echo 'Nope, impossible to move this file';
	}
?>