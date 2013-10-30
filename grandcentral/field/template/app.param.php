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
//	Bind
/********************************************************************************************/
	$_APP->bind_css('css/app.context.css');

/********************************************************************************************/
//	Champ paramètres des apps
/********************************************************************************************/
	$APP = $_PARAM['app'];
	// print '<pre>';print_r($_POST['value']);print'</pre>';
//	récupération des paramètres de l'app
	$params = $APP->get_param();
	// print '<pre>';print_r($APP);print'</pre>';
	$fields = array();
//	construction de la liste des champs
	foreach ((array) $params as $key => $value)
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
			if (is_numeric($value)) $fields[$key] = new fieldNumber($_POST['name'].'[param]['.$key.']', $p);
		//	text
			else $fields[$key] = new fieldText($_POST['name'].'[param]['.$key.']', $p);
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
				$fields[$key] = new fieldBool($_POST['name'].'[param]['.$key.']', $p);
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
				$fields[$key] = new fieldSelect($_POST['name'].'[param]['.$key.']', $p);
			}
		}
	}
?>