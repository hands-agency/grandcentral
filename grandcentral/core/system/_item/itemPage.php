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
	const child = 'child';
	protected $child = false;
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
		// print'<pre>';print_r($this);print'</pre>';
	//	recherche de l'item, si l'url est complexe
		if ($this->exists())
		{
			if (isset($url[1]) && !empty($url[1]))
			{
				$item = item::create($this['type']['item'], array('url' => '/'.$url[1]), $this->get_env());
				define('item', $this['type']['item']);
		
				if ($item->exists())
				{
					registry::set(registry::current_index, 'item', $item);
					$this->child = true;
				}
				else
				{
					$this->get('error_404');
				}
			}
			else
			{
				define('item', 'page');
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
 * Save item into database
 *
 * @access  public
 */
	public function save()
	{
	//	Sauvegarde
		parent::save();
	//	gestion du parent de la page
		if ($this['system']->get() === false && $this['key']->get() != 'home')
		{
			$parent = false;
		//	si la page existe
			if (!$this['id']->is_empty())
			{
			//	on vérifie si la page à un parent
				$q = 'SELECT COUNT(item) as count FROM _rel WHERE item ="page" AND `key` = "child" AND rel="page" AND relid='.$this['id']->get();
				$db = database::connect($this->get_env());
				$r = $db->query($q);
				if ($r['data'][0]['count'] > 0)
				{
					$parent = true;
				}
			}
			
			if ($parent === false)
			{
				$home = cc('page', 'home', $this->get_env());
				$home['child']->add($this);
				$home->save();
			}
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
		$sections = $this['section']->get();
		if ($this->child === true)
		{
			array_unshift($sections, $this['type']['content']);
		}
	//	add section list
		else
		{
			array_unshift($sections, $this['type']['list']);
		}
	//	add section to the page
		$this['section']->set($sections);
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
		$child = $this[self::child]->get();
	//	redirection
		if (count($child) > 0)
		{
			$child = cc($child[0]);
			header('Location:'.$child['url'], false);
		}
	//	erreur
		trigger_error('This header page needs a valid <strong>'.self::child.'</strong> relation to work properly.', E_USER_ERROR);
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