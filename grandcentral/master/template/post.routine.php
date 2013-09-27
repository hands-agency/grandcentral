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
//	sentinel::debug('Our post', $_POST);

/********************************************************************************************/
//	Go
/********************************************************************************************/
	if (!empty($_POST))
	{
		// print '<pre>';print_r($_POST);print'</pre>';
	//	hack magic_quote_gpc
		if (get_magic_quotes_gpc())
		{
			$_POST = stripslashes_deep($_POST);
		}
		
	//	recherche du formulaire de provenance
		$key = array_keys($_POST);
		$form = new item_form($key[0]);
		
		if ($form->exists())
		{
		//	altération du POST
			$_POST = $_POST[$key[0]];
		//	appel de la routine
			echo new routine($form, $form['theme'], $form['action']);
		}
		else
		{
			trigger_error('je ne trouve pas le formulaire '.$key[0], E_USER_WARNING);
		}
	
	}
	
//	function hack pour supprimer les quotes lorsque magic_quote_gpc est actif sur la machine
	function stripslashes_deep($value)
	{
	    $value = is_array($value) ?
                    array_map('stripslashes_deep', $value) :
                    stripslashes($value);

	    return $value;
	}
?>