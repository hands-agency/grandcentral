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
    public function __construct($capeb = null)
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
      // echo "<pre>";print_r($_SESSION['capeb']);echo "</pre>";
      // exit;
      $this->capeb = is_null($capeb) ? $_SESSION['capeb'] : $capeb;
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
      // blacklist
      if (!$this->capeb['newsblacklist']->is_empty())
      {
        $params['id'] = array();
        foreach ($this->capeb['newsblacklist']->get() as $nickname)
        {
          $data = explode('_',$nickname);
          $params['id'][] = '!='.$data[1];
        }
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
      if ($this->capeb['key'] == 'cnational') {
        $keys = ['about1', 'about2', 'about3', 'about4', 'about6'];
      }
      else {
        $keys = ['about1', 'about2', $this->capeb['key'].'_about1', $this->capeb['key'].'_about2', $this->capeb['key'].'_about3', 'about3', 'about4', 'about6'];
      }
      // $parents = i('page', array(
      //   'key' => array('about', $this->capeb['key'].'_about'),
      //   'order()' => 'inherit(key)'
      // ));
      // $pages = array();
      // foreach ($parents as $parent)
      // {
      //   $pages = array_merge($pages, $parent['child']->get());
      // }
      // echo "<pre>";print_r($pages);echo "</pre>";exit;
      $return = new bunch();
      $return->get('page', ['key' => $keys, 'order()' => 'inherit(key)']);

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
          if ($region->count > 0) {
            $params['capeb'] = array($nickname, $region[0]->get_nickname(), self::FALLBACK);
          }
          else $params['capeb'] = array($nickname, self::FALLBACK);

          break;
      }
      // echo "<pre>";print_r($this->capeb['type']->get());echo "</pre>";
      // echo "<pre>";print_r($params);echo "</pre>";
      if (!isset($params['order()']))
      {
        $params['order()'] = 'start ASC';
      }
      // blacklist
      if (!$this->capeb['eventblacklist']->is_empty())
      {
        $params['id'] = array();
        foreach ($this->capeb['eventblacklist']->get() as $nickname)
        {
          $data = explode('_',$nickname);
          $params['id'][] = '!='.$data[1];
        }
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
      $q = 'SELECT id FROM event WHERE start >= "'.date('Y-m-d 00:00:00').'" OR ( start <= "'.date('Y-m-d 00:00:00').'" AND end >= "'.date('Y-m-d 00:00:00').'") AND capeb IN ("capeb_118","'.$this->capeb->get_nickname().'")';
      $db = database::connect('site');
      $r = $db->query($q);
      $ids = array();
      foreach ($r['data'] as $id)
      {
        $ids[] = $id['id'];
      }
      return $this->get_events(array('id' => $ids, 'limit()' => 3));
		}
	/**
	 * Services
	 *
	 * @access public
	 */
		public function get_partners()
		{
      // params
      $p = array(
        'order()' => 'title ASC',
        'capeb' => array(self::FALLBACK, $this->capeb->get_nickname())
      );
      // blacklist
      if (!$this->capeb['partnerblacklist']->is_empty())
      {
        $p['id'] = array();
        foreach ($this->capeb['partnerblacklist']->get() as $nickname)
        {
          $data = explode('_',$nickname);
          $p['id'][] = '!='.$data[1];
        }
      }
      // query
      $partners = new bunch('partner',$p);
      // echo "<pre>";print_r($partners);echo "</pre>";
      return $partners;
		}
	/**
	 * Services
	 *
	 * @access public
	 */
		public function get_sections()
		{
      $sections = i('section',array(
        'capeb' => $this->capeb->get_nickname(),
        'order()' => 'key'
      ));
      return $sections;
		}
	/**
	 * Services
	 *
	 * @access public
	 */
		public function get_texts()
		{
      $texts = i('text',array(
        'capeb' => $this->capeb->get_nickname(),
        'order()' => 'key'
      ));
      return $texts;
		}
	/**
	 * Services
	 *
	 * @access public
	 */
		public function get_facebook()
		{
      $texts = i('section',array(
        'key' => $this->capeb->get_nickname(),
        'order()' => 'key'
      ));
      return $texts;
		}
	/**
	 * Formations
	 *
	 * @access public
	 */
		public function get_trainings($limit = null)
		{
      $trainings = new bunch();
      $p = array(
        'capeb' => $this->capeb->get_nickname(),
        'date' => '>= '.date('Y-m-d'),
        'order()' => 'date ASC'
      );
      if (!is_null($limit)) $p['limit()'] = $limit;
      $trainings->get('training',$p);
      return $trainings;
		}

	/**
	 * Formations
	 *
	 * @access public
	 */
		public function get_referents($services = null)
		{
      $referents = new bunch();
      $params = array(
        'capeb' => $this->capeb->get_nickname(),
        'order()' => 'title ASC'
      );
      if (!is_a($services, 'bunch'))
      {

      }
      $referents->get('referent',$params);
      return $referents;
		}

}
?>
