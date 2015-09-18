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
//	Some debug
/********************************************************************************************/
//	sentinel::debug('Our post', $_POST);
	
/********************************************************************************************/
//	Some functions
/********************************************************************************************/
//	function hack pour supprimer les quotes lorsque magic_quote_gpc est actif sur la machine
	function stripslashes_deep($value)
	{
	    $value = is_array($value) ?
                    array_map('stripslashes_deep', $value) :
                    stripslashes($value);

	    return $value;
	}

/********************************************************************************************/
//	Let's get to work
/********************************************************************************************/
	if (!empty($_POST))
	{
	//	hack magic_quote_gpc
		if (get_magic_quotes_gpc())
		{
			$_POST = stripslashes_deep($_POST);
		}
		
	//	recherche du formulaire de provenance
		$key = array_keys($_POST);
		$form = i('form', $key[0], $_SESSION['pref']['handled_env']);
		
		if ($form->exists())
		{
		//	Are we going to the workflow ?
			if (isset($_POST['workflow'])) $param['workflow'] = $_POST['workflow'];
		//	altération du POST
			$_POST = $_POST[$key[0]];
		//	appel de la routine
			$param['form'] = $form;
			echo app('form', $form['action'], $param);
		}
		else
		{
			trigger_error('Give me a form. Form "'.$key[0].'" does not exists', E_USER_ERROR);
		}
	
	}
?>