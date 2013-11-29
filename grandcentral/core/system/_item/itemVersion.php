<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemVersion extends _items
{
/**
 * Détermine en fonction du contexte la version à afficher
 *
 * @access	public
 */
	public function guess()
	{
	//	si on a une version qui nous a été donnée par la classe boot
		if ($this->get_env() == 'site' && SITE_VERSION != null)
		{
			$param = SITE_VERSION;
		}
	//	sinon on détecte la langue du navigateur
		elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			$param['lang'] = $lang;
		}
		
		if (isset($param) && !empty($param))
		{
			$this->get($param);
		}
		else
		{
			$this->get(1);
		}
		
		return $this;
	}
}
?>