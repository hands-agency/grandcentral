<?php
/**
 * Manage CAPEB datas
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access public
 * @link		http://grandcentral.fr
 */
class dataCapeb
{
  const FALLBACK = 'capeb_118';
  public $capeb;
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
		// public function __construct($capeb = null)
    public function __construct()
		{
      // switch (true)
      // {
      //   // on cherche la capeb à partir de la clé de page
      //   case is_null($capeb):
      //     $page = i('page',current);
      //     $data = explode('_', $page['key']->get());
      //     $count = count($data);
      //     $key = 'cnational';
      //     if ($count > 1 && mb_substr($data[0], 0, 1) == 'c')
      //     {
      //       $key = $data[0];
      //     }
      //     $this->capeb = i('capeb',$key);
      //     break;
      //   // on charge l'item complet
      //   case is_a($capeb, 'itemCapeb'):
      //     $this->capeb = $capeb;
      //     break;
      //   // on le recherche à partir de son nickname
      //   case mb_strstr($capeb, '_'):
      //     $this->capeb = i($capeb);
      //     break;
      //   // sinon erreur
      //   default:
      //     trigger_error('Can\'t find a matching capeb');
      //     break;
      // }
      $this->capeb = $_SESSION['capeb'];
		}
	/**
	 * Retourne la page du national, de la région ou du département
	 *
	 * @access public
	 */
		public function get_page($key)
		{
      // département, région
      if ($this->capeb->get_nickname() != self::FALLBACK)
      {
        $key = $this->capeb['key'].'_'.$key;
      }

      $page = i('page',$key);
      return $page;
		}
	/**
	 * Retourne les items pour la navigation du site
	 *
	 * @access public
	 */
		public function get_nav()
		{
      // echo "<pre>";print_r($this->capeb->get_nickname());echo "</pre>";
      $capeb = $this->capeb;//($_SESSION['capeb']->get_nickname() != self::FALLBACK) ? $_SESSION['capeb'] : $this->capeb;
      // departement / région
			$pages = array();
			if ($capeb->get_nickname() != self::FALLBACK)
			{
				foreach ($this->navigation as $page)
				{
					if (!in_array($page, $this->foreceNational) )
					{
						$pages[] = $capeb['key'].'_'.$page;
					}
					else
					{
						$pages[] = $page;
					}
				}
			}
			// national
			else
			{
				$pages = $this->navigation;
			}
      // requete
			$pages = i('page', array(
				'key' => $pages,
				'order()' => 'inherit(key)'
			));
			return $pages;
		}
	/**
	 * Retourne les itemsNews en fonction des paramètres fournis
	 *
	 * @access public
	 */
		public function get_news($limit = 9, $page = 1, $tag = null)
		{
      $nickname = $this->capeb->get_nickname();
      // default query params
      $start = $page * $limit - $limit;
      $params = array(
        'limit()' => $start.','.$limit,
        'order()' => 'date DESC'
      );
      // capeb
      switch ($this->capeb['type'])
      {
        case 'departement':
          $params['capeb'] = array($nickname, self::FALLBACK);
          $region = i('capeb', array('departement' => $nickname));
          if ($region->count > 0)
          {
            $params['capeb'][] = $region[0]->get_nickname();
          }
          break;
        case 'region':
          $params['capeb'] = array_merge($this->capeb['departement']->get(), array($nickname, self::FALLBACK));
          break;
        case 'national':
          $params['capeb'] = $nickname;
          break;
      }
      // tag
      if (!empty($tag))
      {
        $tag = i('newscategory',$tag);
        $params['category'] = $tag->get_nickname();
      }
      // query news
      $data = i('news', $params);
      // total
      if ($data->count > 0)
      {
        unset($params['limit()']);
        // echo "<pre>";print_r($params);echo "</pre>";
        $data['total'] = count::get('news',$params);
      }
      else
      {
        $data['total'] = 0;
      }

      return $data;
		}
	/**
	 * Liste de textes de présentation
	 *
	 * @access public
	 */
		public function get_presentation()
		{
      $parents = i('page', array(
        'key' => array($this->capeb['key'].'_about', 'about'),
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
	 * Event
	 *
	 * @access public
	 */
		public function get_events($params = array())
		{
      $nickname = $this->capeb->get_nickname();
      switch ($this->capeb['type']->get())
      {
        case 'national':
          $params['capeb'] = $nickname;
          break;
        case 'region':
          $departements = $this->capeb['departement']->get();
          array_push($departements, $nickname, self::FALLBACK);
          $params['capeb'] = $departements;
          break;
        case 'departement':
          $region = i('capeb',array(
            'departement' => $nickname
          ));
          $params['capeb'] = array($nickname, $region[0]->get_nickname(), self::FALLBACK);
          break;
      }
      if (!isset($params['order()']))
      {
        $params['order()'] = 'start ASC';
      }
      $events = i('event', $params);
      return $events;
		}
	/**
	 * Event
	 *
	 * @access public
	 */
		public function get_pushed_events()
		{
      return $this->get_events(array('start' => '>= '.date('Y-m-d')));
		}
	/**
	 * Services
	 *
	 * @access public
	 */
		public function get_services()
		{
      $services = new bunch();
      return $services;
		}
	/**
	 * Services
	 *
	 * @access public
	 */
		public function get_partners()
		{
      $partners = new bunch();
      return $partners;
		}
	/**
	 * Services
	 *
	 * @access public
	 */
		public function get_guides()
		{
      $guides = new bunch();
      return $guides;
		}
	/**
	 * Formations
	 *
	 * @access public
	 */
		public function get_trainings()
		{
      $trainings = new bunch();
      $trainings->get('training',array(
        'capeb' => $this->capeb->get_nickname(),
        // 'date' => '>= '.date('Y-m-d'),
        'order()' => 'date ASC'
      ));
      return $trainings;
		}

	// /**
	//  * Formations
	//  *
	//  * @access public
	//  */
	// 	public function get_referents($services = null)
	// 	{
  //     $referents = new bunch();
  //     $referents->get('referent',array(
  //       'capeb' => $this->capeb->get_nickname(),
  //       'order()' => 'title ASC'
  //     ));
  //     if (!is_a($services, 'bunch'))
  //     {
  //       $params['']
  //     }
  //     $referents->get('referent',$params);
  //     return $referents;
	// 	}

}
?>
