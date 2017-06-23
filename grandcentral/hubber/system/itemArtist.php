<?php
/**
* TDC Artist object
*
* @package  Core
* @author   Sylvain Frigui <sf@cafecentral.fr>
* @access   public
* @see      http://www.cafecentral.fr/fr/wiki
*/
class itemArtist extends _items
{
	/**
	* Obtenir la liste des événements liés à cet artiste
	*
	* @return	bunch  Retourne le bunch des events
	* @access	public
	*/
	public function get_title()
	{
		$tmp = explode(',', $this['title']->get());
		$title = (count($tmp) > 1) ? trim($tmp[1]).' '.trim($tmp[0]) : $this['title']->get();
		return $title;
	}
	/**
	* Obtenir le status de cet artiste
	*
	* @return	bunch  Retourne le bunch des events
	* @access	public
	*/
	public function get_status()
	{
		$type = $this['type'];
		$number = $this['number'];
		if ($number != '0') {
			$sup = $number == '1' ? '<sup>er</sup>' : '<sup>e</sup>';
			$status = $number . $sup . ' ' . t($type);
		}
		else {
			$status = (string) $type;
		}

		return $status;
	}
	/**
	* Obtenir la liste des événements liés à cet artiste
	*
	* @return	bunch  Retourne le bunch des events
	* @access	public
	*/
	public function get_events($params = [])
	{
		$params['casting'] = '%['.$this['id'].']%';
		$events = i('event', $params);
		return $events;
	}
	/**
	* Renourne le nom complet de l'artist
	*
	* @return	bunch  Retourne le bunch des events
	* @access	public
	*/
	public function get_display_name()
	{
		if (isset($this['nickname']) && !$this['nickname']->is_empty()) {
	  	switch ($this['gender']->get()) {
	  		case 'man':
	  			$genderWord = 'dit';
	  			break;

	  		case 'woman':
	  			$genderWord = 'dite';
	  			break;

	  		case 'other':
	  			$genderWord = 'dit(e)';
	  			break;
	  	}
	  	$displayName = $this['firstname']->get() . ' ' . $this['lastname']->get() . '<br>' . $genderWord . ' ' . mb_strtoupper($this['nickname']->get());
	  }
	  else {
	  	$displayName = $this['firstname']->get() . '<br>' . $this['lastname']->get();
	  }

		return $displayName;
	}

	public function get_rel_by_tag($tables = [])
  {
    $tables = (array) $tables;

    if (empty($this->tagrel))
    {
      $tagIds = [];
      foreach ($this['tag'] as $nickname)
      {
        $t = explode('_', $nickname);
        $tagIds[] = $t[1];
      }

      $q = 'SELECT * FROM _rel WHERE rel = "tag" AND item != "event" AND relid IN ('.implode(',',$tagIds).')';
      $db = database::connect('site');
      $r = $db->query($q);
      $datas = [];
      foreach ($r['data'] as $rel)
      {
        if (!empty($tables) && in_array($rel['item'], $tables))
        {
          $datas[$rel['item']][$rel['itemid']] = isset($datas[$rel['item']][$rel['itemid']]) ? $datas[$rel['item']][$rel['itemid']] + 1 : 1;
        }

      }
      $this->tagrel = $datas;
    }
    return $this->tagrel;
  }

  public function get_news() {
    $news = new bunch();
    $tables = array('media','news');
    $rels = $this->get_rel_by_tag($tables);
    foreach ($tables as $table)
    {
      if (isset($rels[$table]))
      {
        $p = [
          'id' => array_keys($rels['media']),
          'order()' => 'created DESC',
          'limit()' => 12
        ];
        if ($table == 'media') $p['type'] = 'pdf';
        $news->get($table, $p);
      }
    }
    return $news;
  }

	/**
	* Save
	*
	* @return	string  Retourne une chaine de caractères
	* @access	public
	*/
	public function save() {
    if ($this['type']->get() == 'eleve') {
      $this['status'] = 'asleep';
    }
		parent::save();
  }
}
?>
