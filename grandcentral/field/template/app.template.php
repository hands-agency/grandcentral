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
//	Ajax
/********************************************************************************************/
	print '<pre>';print_r($_POST);print'</pre>';
	switch ($_POST['search'])
	{
/********************************************************************************************/
//	construction du champ theme
/********************************************************************************************/
		// case 'theme':
		// //	récupération des themes
		// 	$themes = cc('app', $_POST['appkey'])->get_themes($_SESSION['pref']['handled_env']);
		// //	construction du select
		// 	$field = 'theme : nodata';
		// 	if (!empty($themes))
		// 	{
		// 		$params = array(
		// 			'label' => 'theme : ',
		// 			'values' => $themes,
		// 			'valuestype' => 'array',
		// 			'customdata' => array('app' => $_POST['appkey'])
		// 		);
		// 		$field = new field_select($_POST['name'].'[theme]', $params);
		// 		if (!empty($_POST['value'])) $field->set_value($_POST['value']);
		// 	}
		// 	break;
/********************************************************************************************/
//	construction du champ template
/********************************************************************************************/
		case 'template':
		//	récupération des templates
			$templates = cc('app', $_POST['appkey'])->get_templates($_POST['themekey'], 'html', $_SESSION['pref']['handled_env']);
		//	construction du select
			$field = 'template : nodata';
			if (!empty($templates))
			{
				$params = array(
					'label' => 'template : ',
					'values' => $templates,
					'valuestype' => 'array'
				);
				$field = new field_select($_POST['name'].'[template]', $params);
				if (!empty($_POST['value'])) $field->set_value($_POST['value']);
			}
			break;
	}
	
?>