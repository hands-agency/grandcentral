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
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('appmanager/css/appmanager.css');
	$_APP->bind_script('appmanager/js/appmanager.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$apps = array();
	$appEdit = i('page', 'app', env);
	$q = (isset($_POST['q'])) ? $_POST['q'] : null;

/********************************************************************************************/
//	Let's get to work
/********************************************************************************************/
//	App list
	foreach (registry::get(registry::app_index) as $app)
	{
	//	Filter using serachasyoutype
		if (!$q OR strstr($app->get_key(), $q))
		{
			$apps[] = array('key' => $app->get_key(), 'about' => $app->get_ini()['about']);
		}
	}
?>