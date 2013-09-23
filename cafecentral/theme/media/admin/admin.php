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
//	Bind
/********************************************************************************************/
	$_VIEW->bind('css', '/css/media.css');
	$_VIEW->bind('script', '/js/media.js');

/********************************************************************************************/
//	Load Library
/********************************************************************************************/
	$param = array();
	if (isset($_POST['root'])) $param['root'] = $_POST['root'];
	if (isset($_POST['current'])) $param['current'] = $_POST['current'];
	if (isset($_POST['file'])) $param['file'] = $_POST['file'];
	if (isset($_POST['path'])) $param['path'] = $_POST['path'];
	if (isset($_POST['onSelect'])) $param['onSelect'] = $_POST['onSelect'];
	$param = json_encode($param);
	
	$_VIEW->bind('script', '$(\'#mediaLibrary\').ccLibrary('.$param.');');
?>