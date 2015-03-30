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
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/appmanager.css');
	$_APP->bind_script('js/appmanager.js');

/********************************************************************************************/
//	Recherche apps
/********************************************************************************************/
//	dans le répertoire app
	$dir = new dir(ADMIN_APP_ROOT);
	$dir->get();
	// print '<pre>';print_r($dir);print'</pre>';
//	dans le registre
	$installed_apps = registry::get('admin', registry::app_index);
	#print '<pre>';print_r($installed_apps);print'</pre>';
	
	foreach ($dir->data as $value)
	{
		$app['key'] = $value->get_key();
	//	app installée
		if (isset($installed_apps['app_'.$app['key']]))
		{
			$tmp = $installed_apps['app_'.$app['key']]->ini('about');
			$app['title'] = $tmp['title'];
			$app['descr'] = $tmp['descr'];
			$app['installed'] = true;
			$app['edit'] = $installed_apps['app_'.$app['key']]->edit();
		}
	//	non installée
		else
		{
			$tmp = app();
			$tmp['key'] = $app['key'];
			$tmp = $tmp->ini('about');
			$app['title'] = $tmp['title'];
			$app['descr'] = $tmp['descr'];
			$app['url'] = $tmp['url'];
			$app['installed'] = false;
		}
		
		$apps[] = $app;
	}
	
	//print '<pre>';print_r($apps);print'</pre>';
?>