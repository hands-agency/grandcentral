<?php
/**
 * TDC Event object
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemCard extends _items
{
/**
 * Obtenir l'identifiant secutix
 *
 * @return	string  l'identifiant secutix
 * @access	public
 */
	public function get_secutix_id()
	{
		//return mb_substr($this['key']->get(), 1);

        return isset($this['param']['productId']) ? $this['param']['productId'] : null;

	}
/**
 * Obtenir la date formatée pour l'affichage
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_secutix_url()
	{
		return Secutix::url_shop(true).'/selection/membership?productId='.$this->get_secutix_id();
	}
/**
 * Obtenir la date formatée pour l'affichage
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_button()
	{
		return isset($this['hidebutton']) && $this['hidebutton']->get() !== true ? '<a href="'.$this->get_secutix_url().'" class="btn btn-green">'.cst('Adhérer').'</a>' : '';
	}
}
?>
