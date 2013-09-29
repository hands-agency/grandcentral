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
		if (!$this->exists())
		{
			trigger_error('No page found. Give me a 404.', E_USER_ERROR);
		}
	}
/**
 * Envoie les entêtes HTTP de la page
 *
 * @access	public
 */
	public function header()
	{
	//	Content types
		$mime = array(
			'xml' => 'application/xml',
			'html' => 'text/html',
			'routine' => 'text/html'
		);
	//	Convert the GC content type to MIME content types
		$content_type = $mime[$this['template']['type']];
		
	//	Print the header
		header('HTTP/1.0 '.$this['http_status']);
		header('Content-Type: '.$content_type.'; charset=utf-8');
	}
	
/**
 * Affiche les section de la page dans leur zone respectives
 *
 * @access	public
 */
	public function bind_section()
	{
		foreach ($this['section']->unfold() as $section)
		{
			echo $section;
		}
	}
}
?>