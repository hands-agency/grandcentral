<?php
/**
 * TDC Event object
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class fieldCasting extends _fields
{
/**
 * Construit le code html du champ
 *
 * Par défaut la méthode __toString va chercher un template dans /field/default/<nom du champ>
 *
 * @return	string	le html du champ
 * @access	public
 */
	public function __tostring()
	{
		if (empty($this->template))
		{
			$this->template = mb_substr(mb_strtolower(get_called_class()), 5);
		}
		$app = app('hubber', $this->template, array('field' => $this));
		return $app->__tostring();
	}
}
?>
