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
	//	analyse de l'url
		$url[0] = null;
		if (URLR != null)
		{
			$url = explode('/', mb_substr(URLR, 1));
		}
	//	recherche de la page
		$this->get(array('url' => '/'.$url[0]));
		
	//	recherche de l'item, si l'url est complexe
		if ($this->exists())
		{
			if (isset($url[1]) && !empty($url[1]))
			{
				$item = item::create($this['type']['item'], array('url' => '/'.$url[1]), $this->get_env());
		
				if ($item->exists())
				{
					registry::set(registry::current_index, 'item', $item);
				}
				else
				{
					$this->get('error_404');
				}
			}
		}
	//	si la page n'existe pas
		else
		{
			$this->get('error_404');
		}
	//	application des droits
		if ($this->exists() && !$_SESSION['user']->can('see', $this))
		{
			$this->get('login');
		}
	//	si pas de 404
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
		$content_type = $mime[$this['type']['content_type']];
		
	//	Print the header
		header('HTTP/1.0 '.$this['type']['http_status']);
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
/**
 * Display the page
 *
 * @return	string	le code html de la page
 * @access	public
 */
	public function __tostring()
	{
	//	headers
		$this->header();
	//	prepare page display
		$prepareFunction = '_prepare_'.$this['type']['key'];
	//	display
		return $this->$prepareFunction();
	}
/**
 * Prepare display of a feed page
 *
 * @access	public
 */
	private function _prepare_feed()
	{
	//	call master
		$master = new master($this);
	//	add section content
		if (cc('item', current)->exists())
		{
			# code...
		}
	//	add section list
		else
		{
			
		}
	//	add section to the page
		
	//	display master
		return $master->__tostring();
	}
/**
 * Prepare display of a content page
 *
 * @access	public
 */
	private function _prepare_content()
	{
	//	call master
		$master = new master($this);
		// print'<pre>';print_r($master);print'</pre>';
	//	display master
		return $master->__tostring();
	}
/**
 * Prepare display of a header page
 *
 * @access	public
 */
	private function _prepare_header()
	{
	//	recherche du premier enfant
		$child = $this['child']->get();
	//	redirection
		if (count($child) > 0)
		{
			$child = cc($child[0]);
			header('Location:'.$child->link(), false);
		}
	//	erreur
		trigger_error('This header page needs a valid <strong>child</strong> to work properly.', E_USER_ERROR);
	}
/**
 * Prepare display of a link page
 *
 * @access	public
 */
	private function _prepare_link()
	{
	//	redirection
		if (filter_var($this['type']['url'], FILTER_VALIDATE_URL))
		{
			header('Location:'.$this['type']['url'], false);
		}
	//	erreur
		trigger_error('This link page needs a valid <strong>url</strong> to work properly.', E_USER_ERROR);
	}
}
?>