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
//	DEBUG
/********************************************************************************************/
	if (isset($_POST['DEBUG']))
	{
		unset($_POST['DEBUG']);
		sentinel::debug('AJAX debug ('.__FILE__.' line '.__LINE__.')', $_POST);
	}

/********************************************************************************************/
//	Go
/********************************************************************************************/
	if (!empty($_POST))
	{
	//	The app, the theme and the section
		$app = $_POST['app'];
		$theme = $_POST['theme'];
		$template = $_POST['template'];
		
	//	Reroot original $_GET passed as $_POST['_GET'] the $_GET
		if (isset($_POST['_GET']))
		{
			$_GET = $_POST['_GET'];
			unset($_POST['_GET']);
		}
		
	//	Echo
		if (isset($_POST['type']) && $_POST['type'] == 'routine')
		{
			echo new routine($app, $theme, $template);
		}
		else
		{
			$_APP->zone_filename('css', $app.'.'.$theme.'.'.$template);
			$_APP->zone_filename('script', $app.'.'.$theme.'.'.$template);
			echo new html($app, $theme, $template);
			echo '<!-- ZONE:css -->';
			echo '<!-- ZONE:script -->';
		}
	}
?>