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

	// print '<pre>';print_r($_POST);print'</pre>';
	
	switch ($_POST['action'])
	{
/********************************************************************************************/
//	Installer
/********************************************************************************************/
		case 'install':
		//	création d'une nouvelle app
			$app = i('app');
			$app['key'] = $_POST['key'];
			$about = $app->ini('about');
			$app['title'] = $about['title'];
			$app['descr'] = $about['descr'];
		//	création des dépendances
			if ($dep = $app->ini('dependencies'))
			{
			//	ajout des dépendances parentes
				if (isset($dep['parent']))
				{
					$app['dependency'] = $dep['parent'];
				}
			//	création des dépendances enfants
				if (isset($dep['child']))
				{
					foreach ($dep['child'] as $appkey)
					{
						$child = i('app', $appkey);
						if ($child->exists())
						{
							$tmp = $child['dependency'];
							$tmp[] = $app['key'];
							$child['dependency'] = $tmp;
							$child->save();
						}
					}
				}
			}
		//	sauvegarde
			$app->save();
			break;
/********************************************************************************************/
//	Supprimer
/********************************************************************************************/
		case 'remove':
			$app = i('app', $_POST['key']);
			// print '<pre>';print_r($app);print'</pre>';
		//	suppression des dépendances enfants
			if ($dep = $app->ini('dependencies'))
			{
				if (isset($dep['child']))
				{
					foreach ((array) $dep['child'] as $appkey)
					{
						$child = i('app', $appkey);
						if ($child->exists())
						{
							$childDep = (array) $child['dependency'];
							$index = array_search($app['key'], $childDep);
							unset($childDep[$index]);
							$child['dependency'] = $childDep;
							$child->save();
						}
					}
				}
			}
		//	suppression
			$app->delete();
			break;
	}
	// print '<pre>';print_r($app);print'</pre>';
?>