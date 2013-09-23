<?php
/**
 * Routine de login
 * 
 * @package		Form
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	DEBUG
/********************************************************************************************/
// sentinel::debug('$_POST :', $_POST);
	
/********************************************************************************************/
//	Login !
/********************************************************************************************/
//	Default: everybody freeze
	$logged = false;

//	We check if the form is valid
	if ($_ITEM->is_valid())
	{
	//	on recherche l'utilisateur en base
		$user = new human($_POST['login']);

	//	s'il est trouvé et le mot de passe correspond au hash, alors on le log
		if ($user->exists() && $user->is_valid_password($_POST['password']))
		{
		//	Log user
			$user->login();
			$logged = true;
		//	Autologin cookie
			if (isset($_POST['autologin']) && $_POST['autologin'] == true)
			{
				$token = new token();
				$token->generate($user, '+1 day');
				$token->save();
				$token->set_cookie('autologin');
			}
		}
	}
	
//	Whatever happens, just use one ko message to avoid giving out too much secrets
	$return = ($logged == true) ? 'ok' : 'ko';

/********************************************************************************************/
//	Return
/********************************************************************************************/
	echo $return;
?>