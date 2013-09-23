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
//	Routine d'ajout d'objet
/********************************************************************************************/
	sentinel::debug('$_POST :', $_POST);
	
/********************************************************************************************/
//	chargement des pages
/********************************************************************************************/
	$pages = new bunch('page', null, $_SESSION['pref']['handled_env']);
	$pages->get('pagelink');
	$pages->get('pageheader');
//	récupération de la home
	$pages->set_index('key');
	$home = $pages['page_home']->get_nickname();
	// print '<pre>';print_r($home);print'</pre>';
//	modification de l'index du bunch
	$pages->set_index('id');
	sentinel::debug('les pages traitées : ', $pages->get_nickname());
	sentinel::debug('les pages traitées : ', $pages->get_attr('title'));
	
//	traitement du post
	$post = explode('&', $_POST['sitetree']);
	// sentinel::debug('le post traité : ', $post);
	
//	création des relations
	$pattern = '/([a-z0-9_]+)=([a-z0-9_]+)/i';
	foreach ($post as $tmp)
	{
		preg_match($pattern, $tmp, $matches);
		// print '<pre>';print_r($matches);print'</pre>';
		if ($matches[2] == 'home') $matches[2] = $home;
		$rel[$matches[2]][] = $matches[1];
	}
	sentinel::debug('les relations traitées : ', $rel);
	
//	affectation des relations
	foreach ($rel as $parent => $children)
	{
		$pages[$parent]->set_rel('child', $children);
	}
	
//	save
	$pages->save();
?>