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
//	Champ paramètres des apps
/********************************************************************************************/
	// print '<pre>';print_r($_POST['value']);print'</pre>';
//	récupération des paramètres de l'app
	$params = cc('app', $_POST['appkey'])->ini('param');
	// print '<pre>';print_r($params);print'</pre>';
	$fields = array();
//	champ data
	// if (isset($params['data']) && class_exists('field_'.$params['data']))
	// {
	// 	$class = 'field_'.$params['data'];
	// 	$p = array(
	// 		'label' => 'data : '
	// 	);
	// 	$fields['data'] = new $class($_POST['name'].'[param][data]', $p);
	// 	unset($params['data']);
	// }
//	construction de la liste des champs
	foreach ((array) $params as $key => $value)
	{
		if (is_array($value))
		{
			$class = 'field_'.$value['type'];
			if (isset($value['values']))
			{
				$structure = cc('structure', $value['values']);
				$value['values'] = $structure->get_nickname();
			}
			$fields[$key] = new $class($_POST['name'].'[param]['.$key.']', $value);
		}
		else
		{
		//	recherche de la valeur sélectionnée
			preg_match('/\[([a-z_0-9]*)\]/i', $value, $matches);
		//	suppression des caractères inutiles
			$value = str_replace(array(' ','[', ']'), '', $value);
		//	création des listes
			$values = explode(',', $value);
		//	champ text et number
			if (count($values) == 1)
			{
				$p = array(
					'label' => $key,
					'value' => $value
				);
			//	number
				if (is_numeric($value)) $fields[$key] = new field_number($_POST['name'].'[param]['.$key.']', $p);
			//	text
				else $fields[$key] = new field_text($_POST['name'].'[param]['.$key.']', $p);
			}
		//	champ bool et select
			else
			{
			//	bool
				if (count($values) == 2 && in_array('true', $values) && in_array('false', $values))
				{
					$p = array(
						'label' => $key,
						'labelbefore' => true
					);
					if (isset($matches[1]) && $matches[1] == 'true') $p['value'] = $matches[1];
					$fields[$key] = new field_bool($_POST['name'].'[param]['.$key.']', $p);
				}
			//	select
				else
				{
					$p = array(
						'label' => $key,
						'values' => $values,
						'valuestype' => 'array'
					);
					if (isset($matches[1])) $p['value'] = $matches[1];
					$fields[$key] = new field_select($_POST['name'].'[param]['.$key.']', $p);
				}
			}
		}
	}
/********************************************************************************************/
//	Chargement des valeurs en base
/********************************************************************************************/
	$values = array();
//	récupération de la valeur des params
	if (isset($_POST['value']) && !empty($_POST['value']))
	{
		$values = json_decode(stripslashes(htmlspecialchars_decode($_POST['value'], ENT_COMPAT)), true);
	}
//	affectation des valeurs
	foreach ((array) $values as $key => $value)
	{
		if (isset($fields[$key])) $fields[$key]->set_value($value);
	}
?>