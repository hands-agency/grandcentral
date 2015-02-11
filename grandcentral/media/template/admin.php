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
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/media.css');
	$_APP->bind_script('js/mediagallery.plugin.js');

/********************************************************************************************/
//	Load Library
/********************************************************************************************/
	$param = array();
	
	if (isset($_POST['root'])) $param['root'] = $_POST['root'];
	if (isset($_SESSION['user']['pref']['media']['currentroot'])) $param['current'] = $_SESSION['user']['pref']['media']['currentroot'];
	if (isset($_POST['file'])) $param['file'] = $_POST['file'];
	if (isset($_POST['path'])) $param['path'] = $_POST['path'];
	if (isset($_POST['onSelect'])) $param['onSelect'] = $_POST['onSelect'];
	$param = json_encode($param);
	
	$_APP->bind_code('script', '$(\'#mediaLibrary\').mediaGallery('.$param.');');
?>