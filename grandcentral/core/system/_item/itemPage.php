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
		$url[0] = null;
	//	analyse de l'url
		if (URLR != null)
		{
			$url = explode('/', mb_substr(URLR, 1));
		}
	//	recherche de la page
		$this->get(array('url' => '/'.$url[0]));
	//	si la page n'existe pas
		if (!$this->exists())
		{
			$this->get('error_404');
		}
	//	recherche de l'item
		if (isset($url[1]) && !empty($url[1]))
		{
			$item = item::create($this['type']['item'], array('url' => '/'.$url[1]), $this->get_env());
			
			if ($item->exists())
			{
				registry::set(registry::current_index, $this['type']['item'], $item);
			}
			else
			{
				$this->get('error_404');
			}
		}
	//	error
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
		$mime = $this->get_authorised_mime();
	//	Convert the GC content type to MIME content types
		$content_type = $mime[$this['master']['type']];
		
	//	Print the header
		header('HTTP/1.0 '.$this['http_status']);
		header('Content-Type: '.$content_type.'; charset=utf-8');
	}
/**
 * Envoie les entêtes HTTP de la page
 *
 * @access	public
 */
	public function get_authorised_mime()
	{
	//	Content types
		$mime = array(
			'xml' => 'application/xml',
			'json' => 'application/json',
			'html' => 'text/html',
			'routine' => 'text/x-php',
			'eventstream' => 'text/event-stream',
		);
		return $mime;
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
			$section->__tostring();
		}
	}
}
?>