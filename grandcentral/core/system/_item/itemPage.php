<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemPage extends _items
{
/**
 * Détermine en fonction du contexte quelle page afficher
 *
 * @access	public
 */
	public function guess()
	{
	//	recherche par urlr
		$url = (URLR == '') ? '/' : URLR;
		$this->get(array('url' => $url));
		if (!$this->exists())
		{
			$this->get('error_404');
		}
	}
/**
 * Envoie les entêtes HTTP de la page
 *
 * @access	public
 */
	protected function header()
	{
		$template = $this['template'];
		$view = $template['type'];
		$content_type = $view::content_type;
		
		header('HTTP/1.0 '.$this['http_status']);
		header('Content-Type: '.$content_type.'; charset=utf-8');
	}
/**
 * Returns the front-end URL of an item
 *
 * @param	array	An associative array of arguments added to the URL
 * @return	string	The URL of the object
 * @access	public
 */
	public function link($arg = null)
	{
	//	Return
		if (isset($this['url']))
		{
		//	Args?
			if (isset($arg)) $arg = '?'.http_build_query($arg);
		//	Return
			return constant(mb_strtoupper($this->get_env()).'_URL').$this['url'].$arg;
		}
		else return false;
	}
}
?>