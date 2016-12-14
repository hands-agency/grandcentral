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
	const FALLBACK = 'cnational'; // item à charger par défaut
	private static $overlay = true;
	private $navigation = array(
    'news',
    'event',
    'about',
    'intent',
    'service',
    'contact'
  );
  private $foreceNational = array(
    'intent',
    'contact'
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
			// analyse page key
			$page = i('page',current);
			$data = explode('_', $page['key']->get());
			$count = count($data);
			// echo "<pre>";print_r(registry::get());echo "</pre>";exit;
	    if ($count > 1 && mb_substr($data[0], 0, 1) == 'c')
	    {
	      $key = $data[0];
				$capeb->get($key);
	    }
			// on force la session pour certaines pages du national le national
			elseif (in_array($page['key']->get(), array('home','about')))
			{
				$capeb->get('cnational');
			}
			else
			{
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
			$this->get(self::FALLBACK);
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
		public function get_dep()
		{
			//
			return mb_substr($this['zip'], 0, 2);
		}

	// /**
	//  *
	//  *
	//  * @access public
	//  */
	// 	public function get_url($destination)
	// 	{
	// 		$key = $this['key']->get() == self::FALLBACK ? $destination : $this['key']->get().'_'.$destination;
	// 		$page = i('page', $key);
	// 		return (string) $page['url'];
	// 	}

	/**
	 *
	 *
	 * @access public
	 */
		public function redirect()
		{
			//
			header('Location: '.$this->get_url('home'));
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

	// /**
	//  *
	//  *
	//  * @access public
	//  */
	// 	public function get_news()
	// 	{
	// 		//
	// 	}

	// /**
	//  *
	//  *
	//  * @access public
	//  */
	// 	public function get_page_capeb()
	// 	{
	// 		$page = i('page', current);
	// 		$key = $page['key']->get();
	// 		if (mb_strstr($key,'_'))
	// 		{
	// 			$data = explode('_',$key);
	// 			if ($data[0] == $this['key']->get())
	// 			{
	// 				$capeb = $this;
	// 			}
	// 			else
	// 			{
	// 				$capeb = i('capeb',$data[0]);
	// 			}
	// 		}
	// 		else
	// 		{
	// 			if (self::FALLBACK == $this['key']->get())
	// 			{
	// 				$capeb = $this;
	// 			}
	// 			else
	// 			{
	// 				$capeb = i('capeb',self::FALLBACK);
	// 			}
	// 		}
	// 		return $capeb;
	// 	}

	// /**
	//  *
	//  *
	//  * @access public
	//  */
	// 	public function get_presentation_list()
	// 	{
	// 		$parents = i('page', array(
	// 			'key' => array($this['key'].'_about', 'about'),
	// 			'order()' => 'inherit(key)'
	// 		));
	// 		// echo "<pre>";print_r($parents);echo "</pre>";
	// 		$pages = array();
	// 		foreach ($parents as $parent)
	// 		{
	// 			$pages = array_merge($pages, $parent['child']->get());
	// 		}
	// 		$return = new bunch();
	// 		$return->get_by_nickname($pages);
	//
	// 		return $return;
	// 	}

	// /**
	//  * get data to populate site navigation
	//  *
	//  * @access public
	//  */
	// 	public function get_nav()
	// 	{
	// 		// departement / région
	// 		$pages = array();
	// 		if ($this['key']->get() != self::FALLBACK)
	// 		{
	// 			foreach ($this->navigation as $page)
	// 			{
	// 				if (!in_array($page, $this->national) )
	// 				{
	// 					$pages[] = $this['key'].'_'.$page;
	// 				}
	// 				else
	// 				{
	// 					$pages[] = $page;
	// 				}
	// 			}
	// 		}
	// 		// national
	// 		else
	// 		{
	// 			$pages = $this->navigation;
	// 		}
	// 		$pages = i('page', array(
	// 			'key' => $pages,
	// 			'order()' => 'inherit(key)'
	// 		));
	// 		return $pages;
	// 	}
}
?>
