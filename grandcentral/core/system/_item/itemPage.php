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
		
	//	recherche de l'item, si l'url est complexe
		if ($this->exists())
		{
		//	reader
			if (isset($url[1]) && !empty($url[1]))
			{
				$item = item::create($this['type']['item'], array('url' => '/'.$url[1]), $this->get_env());
				if ($item->exists())
				{
					define('item', $this['type']['item']);
					registry::set(registry::current_index, item, $item);
					$this->child = true;
				}
				else
				{
					$this->get('error_404');
				}
			}
		//	pas de reader
			else
			{
				define('item', 'page');
			}
		}
	//	HACK pour le reader de la home
		elseif ($reader = registry::get(registry::reader_index, '/'))
		{
			$item = item::create($reader['type']['item'], array('url' => '/'.$url[0]), $this->get_env());
			
			if ($item->exists())
			{
				define('item', $reader['type']['item']);
				registry::set(registry::current_index, item, $item);
				$this->get('home');
				$this->child = true;
			}
			else
			{
				$this->get('error_404');
			}
		//	si la page n'existe pas
			// $this->get('error_404');
		}
		else
		{
			$this->get('error_404');
		}
// print'<pre>';print_r($this['section']);print'</pre>';
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
			'json' => 'text/html',
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
	//	prepare page display
		$prepareFunction = '_prepare_'.$this['type']['key'];
	//	error
		if (!method_exists($this, $prepareFunction))
		{
			trigger_error('Cannot display page. I need a valid type.', E_USER_ERROR);
		}
	//	headers
		$this->header();

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
/**
 * Get a bunch with all the children of the page
 *
 * @access	public
 */
	public function get_children()
	{
		return $this['child']->unfold();
	}
/**
 * Get a bunch with the direct parent of the page or all of his parents
 *
 * @param	int		deep of the ancestors
 * @return	bunch	a bunch of pages
 * @access	public
 */
	public function get_parent()
	{
		$page = $this->get_nickname();
		$parent = $this->_get_parent_nickname($page);
	//	get the items
		$b = new bunch(null, null, $this->get_env());
	//	return
		return $b->get_by_nickname($parent);
	}
/**
 * Get a bunch with the direct all of the ancestors of the page
 *
 * @return	bunch	a bunch of pages
 * @access	public
 */
	public function get_parents()
	{
		$page = $this->get_nickname();
	//	get ancestors
		while ($page = $this->_get_parent_nickname($page))
		{
			$parent[] = $page;
			$i++;
		}
		$parent = (isset($parent)) ? array_reverse($parent) : null;
	//	get the items
		$b = new bunch(null, null, $this->get_env());
	//	return
		return $b->get_by_nickname($parent);
	}
/**
 * Get a bunch with the pages at the same level of the current page
 *
 * @param	bool	if true return also the current page (default : true)
 * @return	bunch	a bunch of pages
 * @access	public
 */
	public function get_siblings($params = null, $self = true)
	{
		$tree = (array) registry::get(registry::legacy_index);
		
		foreach ($tree as $parent => $children)
		{
			if (in_array($this->get_nickname(), $children))
			{
				$b = new bunch(null, null, $this->get_env());
				if ($self === false)
				{
					$index = array_search($this->get_nickname(), $children);
					unset($children[$index]);
				}
				return $b->get_by_nickname($children);
			}
		}
	//	return
		return null;
	}
/**
 * Check if the page given in parameter is the parent of $this
 *
 * @param	mixed	an itemPage or a page nickname
 * @return	bool	true if parent exists, false otherwise
 * @access	public
 */
	public function is_child_of($parent)
	{
		$page = $this->get_nickname();
		$parent = (is_a($parent, 'itemPage')) ? $parent->get_nickname() : $parent;
		
		while ($page = $this->_get_parent_nickname($page))
		{
			if ($parent == $page) return true;
		}
		return false;
	}
/**
 * Check if the page given in parameter is the child of $this
 *
 * @param	mixed	an itemPage or a page nickname
 * @return	bool	true if parent exists, false otherwise
 * @access	public
 */
	public function is_parent_of($child)
	{
		$page = $this->get_nickname();
		$child = (is_a($child, 'itemPage')) ? $child->get_nickname() : $child;
		
		while ($child = $this->_get_parent_nickname($child))
		{
			if ($child == $page) return true;
		}
		
		return false;
	}
/**
 * Get a bunch with the direct parent of the page or all of his parents
 *
 * @param	mixed	an itemPage or a page nickname
 * @access	public
 */
	protected function _get_parent_nickname($page)
	{
		$return = false;
		
		// var_dump();
		if (is_a($page, 'itemPage') || mb_strpos($page, 'page_') !== false)
		{
			// var_dump($bool);
			$nickname = (is_a($page, 'itemPage')) ? $page->get_nickname() : $page;
			$tree = (array) registry::get(registry::legacy_index);
			// print'<pre>';print_r($tree);print'</pre>';
			foreach ($tree as $parent => $children)
			{
				if (in_array($nickname, $children))
				{
					$return = $parent;
					break;
				}
			}
		}
		
		return $return;
	}
/**
 * Get the level of the page in the site tree
 *
 * @return	int		the level of the current page
 * @access	public
 */
	public function get_level()
	{
		$parent = array();
		$page = $this->get_nickname();
		while ($page = $this->_get_parent_nickname($page))
		{
			$parent[] = $page;
		}
		return count($parent);
	}
}
?>