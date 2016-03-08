<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemPage extends _items
{
	const child = 'child';
	protected $child = false;
	protected $zoning = false;
/**
 * Active ou désactive l'encapsulage des zones et des sections sur la page pour le mode d'édition
 *
 * @param	bool
 * @access	public
 */
	public function set_zoning($bool = true)
	{
		$this->zoning = (bool) $bool;
		return $this;
	}
/**
 * Retourne la valeur de $this->zoning
 *
 * @return	bool
 * @access	public
 */
	public function get_zoning()
	{
		return $this->zoning;
	}
/**
 * Tells whether a page is a reader of another item
 *
 * @access	public
 */
	public function is_reader()
	{
		return (is_array(registry::get(registry::reader_index, $this->get_nickname()))) ? true : false;
	}
/**
 * Get the read object of this reader
 *
 * @access	public
 */
	public function get_reader()
	{
		if ($this->is_reader())
		{
			$readItem = registry::get(registry::reader_index, $this->get_nickname());
			return $readItem[0]['param']['item'];
		}
		else return false;
	}
/**
 * Rechercher une page avec une url
 *
 * @access	public
 */
	public function get_by_url($url = null)
	{
		if (empty($url)) $url = '/';
		$version = i('version',current)['lang']->get();
		$this->get(array(
			'url' => array(
				'%"'.$version.'____'.$url.'"%', // new format
				$url // old format
			),
			'limit()' => 1)
		);
	}
/**
 * Guess the page to display
 *
 * @access	public
 */
	public function guess()
	{
		// recherche de la page
		$this->get_by_url(URLR);
		//	si la page n'existe pas, on éclate l'url et on fait une recherche aproximative
		if (!$this->exists())
		{
			$hash = mb_substr(URLR, 0, mb_strpos(URLR, '/', 1));
			// chargement de la page de home
			$this->get_by_url($hash);
			// sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $this);exit;
			// 404
			// echo "<pre>";print_r('ici');echo "</pre>";exit;
			if ($this->get_env() == 'site' && !$this->is_reader() && !mb_strstr($hash,'api'))
			//if (!$this->exists())
			{
				// echo "<pre>";print_r('ici');echo "</pre>";exit;
				$this->get_by_url('/404');
			}
		}

		// si on ne trouve rien, on renvoie une erreur
		if (!$this->exists())
		{
			$this->get_by_url('/404');
		}
	}
/**
 * Save item into database
 *
 * @access  public
 */
	public function save()
	{
	//	Save first
		parent::save();

	//	If this page has a specified parent...
		if (isset($this['parent']) && !$this['parent']->is_empty())
		{
		//	...hook'em up
			$parent = $this['parent']->unfold();
			if (is_a($parent, 'bunch')) $parent = $parent[0];
			// sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $parent);
			$parent['child']->add($this);
			$parent->save();
		//	Clean the instruction
			$this['parent'] = null;
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
			// 'json' => 'text/html',
			'csv' => 'text/csv',
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
		// maintenance
		if (SITE_MAINTENANCE === true && env == 'site' && $this['key'] != 'login.post' && !$_SESSION['user']->is_admin())
		{
			$this->get('maintenance');
		}
		// application des droits
		if (!$_SESSION['user']->can('see', $this))
		{
			$this->get('login');
		}
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
 * Prepare display of a content page
 *
 * @access	private
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
 * @access	private
 */
	private function _prepare_header()
	{
	//	recherche du premier enfant
		$child = $this[self::child]->get();
	//	redirection
		if (count($child) > 0)
		{
			$child = i($child[0]);
			header('Location:'.$child['url'], false);
		}
	//	erreur
		trigger_error('This header page needs a valid <strong>'.self::child.'</strong> relation to work properly.', E_USER_ERROR);
	}
/**
 * Prepare display of a link page
 *
 * @access	private
 */
	private function _prepare_link()
	{
	//	redirection
		if (filter_var($this['type']['url'], FILTER_VALIDATE_URL))
		{
			header('Location:'.$this['type']['url'], false);
		}
		else
		{
			header('Location:'.i($this->get_env(), current)['version']->get_url().$this['type']['url'], false);
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
 * Get a bunch with the direct parent of the page
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

		$b = new bunch(null, null, $this->get_env());

		foreach ($tree as $parent => $children)
		{
			if (in_array($this->get_nickname(), $children))
			{

				if ($self === false)
				{
					$index = array_search($this->get_nickname(), $children);
					unset($children[$index]);
				}
				return $b->get_by_nickname($children);
			}
		}
	//	return
		return $b;
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
/**
 * On charge toutes les urls des pages du site
 *
 * @param	mixed	la valeur à lire dans le registre. Vous pouvez mettre autant d'arguments que vous le souhaitez.
 * @access	public
 */
/**
 * On charge toutes les url et les types de pages
 *
 * @access	protected
 */
	public static function register()
	{
		if (!registry::get(registry::url_index) && !registry::get(registry::legacy_index) && !registry::get(registry::reader_index))
		{
			$db = database::connect('site');
			// on recherche toutes les urls des pages
			$q = 'SELECT `id`, `url` FROM `page`';
			$r = $db->query($q);
			foreach ($r['data'] as $page)
			{
				$urls['page_'.$page['id']] = $page['url'];
			}
			// on recherche les readers dans le table section
			$q = 'SELECT `id`, `app` FROM `section` WHERE `app` LIKE "%\"app\":\"reader\"%" OR  `app` LIKE "%\"app\":\"api\"%" OR  `app` LIKE "%\"app\":\"doc\"%"';
			$r = $db->query($q);
			// traitement de la requête pour stockage
			$hash = null;
			$readersid = array();
			if ($r['count'] > 0)
			{
				foreach ($r['data'] as $reader)
				{
					$readersId[] = $reader['id'];
					$readersTable[$reader['id']] = json_decode($reader['app'], true);
				}
				$hash = ' OR (`rel`="section" AND `relid` IN ('.implode(',',$readersId).'))';
			}
			// on recherche les pages liées aux readers et les liaisans entre les pages
			$q = 'SELECT * FROM `_rel` WHERE `item`="page" AND (`key`="child"'.$hash.') ORDER BY `itemid`, `position`';
			$r = $db->query($q);
			$readers = $tree = array();
			foreach ($r['data'] as $rel)
			{
				if ('child' == $rel['key'])
				{
					$tree[$rel['item'].'_'.$rel['itemid']][] = $rel['rel'].'_'.$rel['relid'];
				}
				else
				{
					$readers[$rel['item'].'_'.$rel['itemid']][] = $readersTable[$rel['relid']];
				}
			}
			// mise en registre
			registry::set(registry::url_index, $urls);
			registry::set(registry::legacy_index, $tree);
			registry::set(registry::reader_index, $readers);
		}
	}
}
?>
