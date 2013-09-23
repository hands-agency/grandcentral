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
//	Debug
/********************************************************************************************/
//	Post
//	sentinel::debug('$_POST :', $_ITEM);

/********************************************************************************************/
//	Routine d'ajout d'objet
/********************************************************************************************/
	
	//print '<pre>';print_r($_ITEM);print'</pre>';
//	si le formulaire est valide
	// if ($_ITEM->is_valid())
	// {
		
	//	Fetch the form
		list($env, $table, $section) = explode('_', $_ITEM['key']);

	//	on détermine la bonne classe à utiliser
		$i = item::create($table, null, $env);
	//	on chreche l'ancien objet
		if (isset($_POST['id']) && !empty($_POST['id']))
		{
			$i->get($_POST['id']);
		}
	//	on peuple l'objet avec le post
		foreach ($_POST as $key => $value)
		{
		//	les attributs
			if (!$i->rel_exists($key))
			{
				$i[$key] = $value; 
			}
		//	les relations
			else
			{
				$i->set_rel($key, $value);
			}
		}
		// print '<pre>';print_r($i);print'</pre>';
	//	on sauvegarde
		$i->save();
		// sentinel::debug('Retour :', '<a href="'.$_ITEM->get_back().'" title="">'.$_ITEM->get_back().'</a>');
		// sentinel::debug('Objet sauvegardé :', $i);
	//	irels
		// foreach ($_POST as $key => $value)
		// {
		// 	$field = $_ITEM->fields[$key]->get_attr();
		// 	if (isset($field['irel']) && !empty($field['irel']) && !empty($value))
		// 	{
		// 		list($ptable, $pid) = explode('_', $value);
		// 		$parent = item::create($ptable, $pid, $i->get_env());
		// 		$parent->add_rel($field['irel'], $i['id']);
		// 		$parent->save();
		// 		print '<pre>irel : ';print_r($parent);print'</pre>';
		// 	}
		// }
	//	Send back the id to ajax
		echo $i['id'];
	// }
//	si le fomulaire n'est pas valide
	// else
	// {
	// //	sentinel::debug('Retour :', '<a href="'.$_ITEM->get_back_error().'" title="">'.$_ITEM->get_back_error().'</a>');
	// //	sentinel::debug('Erreurs rencontrées :', $_ITEM->get_error());
	// }
?>