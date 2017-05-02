<?php
/**
 * TDC News object
 *
 * @package  TDC
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemNews extends _items
{
/**
 * Affichage du push de l'event
 *
 * @return	bunch  Retourne le bunch des séances de l'événement
 * @access	public
 */
	public function get_push()
	{
		$app = app('content', '/push/news', array('item' => $this));
		return $app->__tostring();
	}
}
?>