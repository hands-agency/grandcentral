<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
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
		if (isset($this->param['key']))
		{
			//	on recherche dans la base le form correspondant au param['key']
			$form = i('form', $this->param['key'], 'admin');
			//	si le form existe, on le monte dans les paramètres
			if ($form->exists())
			{
				$this->param['form'] = $form->prepare();
			}
		}
	}
}
?>