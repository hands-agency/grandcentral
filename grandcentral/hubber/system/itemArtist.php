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
	  	$displayName = $this['firstname']->get() . '<br>' . $this['lastname']->get() . ' ' . $genderWord . ' ' . mb_strtoupper($this['nickname']->get());
	  }
	  else {
	  	$displayName = $this['firstname']->get() . '<br>' . $this['lastname']->get();
	  }

		return $displayName;
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
