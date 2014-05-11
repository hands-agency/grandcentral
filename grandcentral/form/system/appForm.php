<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class appForm extends _apps
{
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  admin ou site (environnement courant par défaut)
 * @access	public
 */
	public function prepare()
	{
		//	on recherche dans la base le form correspondant au param['key']
		$form = i('form', $this->param['key']);
		//	si le form existe, on le monte dans les paramètres
		if ($form->exists())
		{
			$this->param['form'] = $form->prepare();
		}
	}
}
?>