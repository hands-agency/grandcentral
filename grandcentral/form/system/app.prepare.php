<?php
/**
 * Préparation des paramètres de l'app form avant son affichage
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
//	on recherche dans la base le form correspondant au param['key']
	$form = cc('form', $this->param['key']);
//	si le form existe, on le monte dans les paramètres
	if ($form->exists())
	{
		$this->param['form'] = $form->prepare();
	}
?>