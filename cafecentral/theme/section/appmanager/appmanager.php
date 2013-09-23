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
	$_VIEW->bind('css', '/css/appmanager.css');
	$_VIEW->bind('script', '/js/appmanager.js');

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
			$tmp = new app();
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