<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access public
 * @link		http://grandcentral.fr
 */
class itemCapeb extends _items
{
	private $default = 'cnational'; // item à charger par défaut
	private static $overlay = true;
	private $navigation = array(
		'news',
		'event',
		'about',
		'intent',
		'service'
	);
	private $national = array(
		'intent'
	);
	/**
	 *	Create cookie, session and return active capeb
	 *
	 * @access public
	 */
		public static function init()
		{
			// init itemCapeb
			$capeb = i('capeb');
			// si la session existe
			if (isset($_SESSION['capeb']) && is_a($_SESSION['capeb'], 'itemCapeb') && $_SESSION['capeb']->exists())
			{
				$capeb = $_SESSION['capeb'];
			}
			elseif (isset($_COOKIE['capeb']) && !empty($_COOKIE['capeb']))
			{
				// on cherche la capeb en base
				$capeb->get($_COOKIE['capeb']);
			}
			$capeb->load();
			return $capeb;
		}
	/**
	 * Create cookie and session of the current item if exists. Load_default() otherwise.
	 *
	 * @access public
	 */
		public function load()
		{
			if ($this->exists())
			{
				$this->create_cookie();
				$this->set_session();
				self::$overlay = false;
			}
			else
			{
				$this->load_default();
			}
			return $this;
		}
	/**
	 * Load defaut item (define par the $default property)
	 *
	 * @access public
	 */
		public function load_default()
		{
			$this->get($this->default);
	    $this->create_cookie();
			$this->set_session();
			return $this;
		}
	/**
	 * Détermine si l'overlay du réseau doit être affiché
	 *
	 * @access public
	 * @return boolean
	 */
		public function is_overlayed()
		{
			return self::$overlay;
		}
	/**
	 *
	 *
	 * @access public
	 */
		public function get_key()
		{
			//
			return $this['key'];
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function get_name()
		{
			//
			return $this['shorttitle'];
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function get_home_url()
		{
			//
			$page = i('page', $this->get_key().'_home');
			$url = (string) $page['url'];

			return $url;
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function redirect()
		{
			//
			header('Location: '.$this->get_home_url());
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function create_cookie()
		{
			if (!$this['key']->is_empty())
			{
				setcookie('capeb', $this['key']->get(), time() + (3600 * 24 * 30 * 3), '/', '', false, true);
			}
	    else
			{
	    	trigger_error('La "key" ne peut être vide.', E_USER_NOTICE);
	    }
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function set_session()
		{
			$_SESSION['capeb'] = $this;
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function get_news()
		{
			//
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function get_events()
		{
			//
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function get_presentation_list()
		{
			$parents = i('page', array(
				'key' => array($this['key'].'_about', 'about'),
				'order()' => 'inherit(key)'
			));
			// echo "<pre>";print_r($parents);echo "</pre>";
			$pages = array();
			foreach ($parents as $parent)
			{
				$pages = array_merge($pages, $parent['child']->get());
			}
			$return = new bunch();
			$return->get_by_nickname($pages);

			return $return;
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function get_nav()
		{
			$pages = array();
			if ($this['key']->get() != $this->default)
			{
				foreach ($this->navigation as $page)
				{
					if (!in_array($page, $this->national) )
					{
						$pages[] = $this['key'].'_'.$page;
					}
					else
					{
						$pages[] = $page;
					}
				}
			}
			else
			{
				$pages = $this->navigation;
			}
			$pages = i('page', array(
				'key' => $pages,
				'order()' => 'inherit(key)'
			));
			return $pages;
		}
}
?>
