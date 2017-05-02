<?php
/**
 * TDC Event object
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemEvent extends _items
{
/**
 * Savoir si la séance est une production Chatelet
 *
 * @return	bunch  Retourne le bunch des séances de l'événement
 * @access	public
 */

    var $isAlone = false;

	public function is_prodchatelet()
	{
		return $this['ispush']->__tostring();
	}
/**
 * Savoir si l'événement est encore actif
 *
 * @return	bunch  Retourne le bunch des séances de l'événement
 * @access	public
 */
	public function is_disabled()
	{
		$date = $this['end']->is_empty() ? $this['start'] : $this['end'];
		return date('Y-m-d H:i:s') > $date ? true : false;
	}
/**
 * Savoir si l'événement est encore actif
 *
 * @return	bunch  Retourne le bunch des séances de l'événement
 * @access	public
 */
	public function is_festival()
	{
		return $this['festival']->is_empty() ? false : true;
	}
/**
 * Obtenir toutes les séances de l'event
 *
 * @return	bunch  Retourne le bunch des séances de l'événement
 * @access	public
 */
	public function get_seances()
	{
		$s = i('seance', array(
			'event' => $this->get_nickname(),
			'date' => '> '.date('Y-m-d H:i:s'),
			'order()' => 'date asc'
		));
		return $s;
	}
/**
 * Obtenir la date formatée pour l'affichage
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_formated_date()
	{

		switch (true)
		{
      // pas de date remplie
			case $this['start']->is_empty() && $this['end']->is_empty():
				$return = null;
				break;
    // si date de départ et de fin avec année différentes
      case !$this['start']->is_empty() && !$this['end']->is_empty() && $this['start']->format('Y') != $this['end']->format('Y'):
        $sday = $this['start']->format('j') == '1' ? $this['start']->format('j').cst('DATE_DAY_FIRST') : $this['start']->format('j');
        $smonth = $this['start']->format('n') == $this['end']->format('n') ? null : cst('MONTH_'.$this['start']->format('n'));
        $eday = $this['end']->format('j') == '1' ? $this['end']->format('j').cst('DATE_DAY_FIRST') : $this['end']->format('j');
        $return = cst('EVENT_BOX_DATE_START_DATE_END', array(
          'sday' => $sday,
          'smonth' => $smonth,
          'syear' => $this['start']->format('Y'),
          'eday' => $eday,
          'emonth' => cst('MONTH_'.$this['end']->format('n')),
          'eyear' => $this['end']->format('Y')
        ));
        break;
      // si date de départ uniquement ou si jour et mois de la date de début de et fin correspondent
			case !$this['start']->is_empty() && $this['end']->is_empty():
			case !$this['start']->is_empty() && !$this['end']->is_empty() && $this['start']->format('dn') == $this['end']->format('dn'):
				$sday = $this['start']->format('j') == '1' ? $this['start']->format('j').cst('DATE_DAY_FIRST') : $this['start']->format('j');
        $hour = $this['start']->format('i') == '00' ? $this['start']->format('H\h') : $this['start']->format('H\hi');
				$return = cst('EVENT_BOX_DATE_START', array(
					'sday' => $sday,
					'smonth' => cst('MONTH_'.$this['start']->format('n')),
					'year' => cst($this['end']->format('Y')),
          'hour' => '&nbsp;'.$hour
				));
				break;
			default:
				$sday = $this['start']->format('j') == '1' ? $this['start']->format('j').cst('DATE_DAY_FIRST') : $this['start']->format('j');
				$smonth = $this['start']->format('n') == $this['end']->format('n') ? null : cst('MONTH_'.$this['start']->format('n'));
				$eday = $this['end']->format('j') == '1' ? $this['end']->format('j').cst('DATE_DAY_FIRST') : $this['end']->format('j');
				$return = cst('EVENT_BOX_DATE_END', array(
					'sday' => $sday,
					'smonth' => $smonth,
					'eday' => $eday,
					'emonth' => cst('MONTH_'.$this['end']->format('n')),
					'year' => $this['end']->format('Y')
				));
				break;
		}
		return $return;
	}
/**
 * Obtenir l'identifiant secutix
 *
 * @return	string  l'identifiant secutix
 * @access	public
 */
	public function get_secutix_id()
	{
		//return mb_substr($this['key']->get(), 1);
        preg_match("/s([^_]*)/",$this['key']->get(),$matches);
        return isset($matches[1]) ? $matches[1] : null;
	}
/**
 * Obtenir la date formatée pour l'affichage
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_secutix_url()
	{
		$is_structure = SecutixUser::isStructure();
    $version = i('version',current)['lang'];
		if($is_structure){
			return Secutix::url_shop().'/option/event/detail?lang='.$version.'&productId='.$this->get_secutix_id();
		}else{
			return Secutix::url_shop().'/selection/event/date?lang='.$version.'&productId='.$this->get_secutix_id();
		}

	}
/**
 * Obtenir la date formatée pour l'affichage
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_button()
	{
		$button = null;

		// si on a une seule séance, alors on récupère le bouton de la séance

		if ($this->is_disabled())
		{
			return null;
		}
		if ($this['start']->get() == $this['end']->get())
		{
			$seance = i('seance', array(
				'event' => $this->get_nickname()
			));
      foreach ($seance as $value)
      {
        $return = $value->get_button();
        if (!empty($return)) break;
      }
        // echo "<pre>";print_r($seance);echo "</pre>";
			return isset($return) && !empty($return) ? $return : '';
		}
		// sinon on construit le bouton
		$status = $this->get_status();


		/*if (mb_substr($this['key'], 0, 1) == 's')
		{
			switch (true)
			{
				case $this->is_disabled():
					$return = null;
					break;
				case $this['dispo']->get() == 0:
					$return = '<span class="full">'.t('Le contingent internet est désormais complet. Des places à visibilité réduite restent disponibles au 01 40 28 28 40 et aux guichets.').'</span>'; // '<a class="btn btn-black">'.t('Complet').'</a>'
					break;
				case $this['start']->get() == $this['end']->get():
					$seance = i('seance', array(
						'event' => $this->get_nickname(),
						'limit' => 1
					));
					$return = $seance->count == 1 ? $seance[0]->get_button() : null;
					break;
				default:
					$return = '<a href="'.$this->get_secutix_url().'" class="btn btn-green">'.cst('RÉSERVER').'</a>';
					break;
			}
		}*/
		if (!is_null($status))
		{
			$button = '';
			if (!$status['text']->is_empty())
			{
				$text = $status['text'];
				if (mb_strstr($text, '[date]'))
				{
					$tfrom[] = '[date]';
					$tto[] = $this['salestart']->format('d/m/Y à H\hi');
					$text = str_replace($tfrom, $tto, $text);
				}
				$button .= '<span class="btn-text">'.nl2br($text).'</span>';
			}
			if (!$status['buttoncolor']->is_empty() && !$status['buttontext']->is_empty())
			{
				$link = (in_array($status['key']->get(), array('open', 'last'))) ? $this->get_secutix_url() : $status['buttonlink']->get();
				if (!$status['buttonlink']->is_empty())
				{
					$from[] = '[eventid]';
					$to[] = $this->get_secutix_id();
					$button .= '<a href="'.str_replace($from, $to, $link).'" class="btn btn-green" style="background-color:#'.$status['buttoncolor'].'">'.$status['buttontext'].'</a>';
				}
				else
				{
					$button .= '<span class="btn" style="background-color:#'.$status['buttoncolor'].'">'.$status['buttontext'].'</span>';
				}

			}
		}

		return $button;
	}
/**
 * Obtenir le status de l'événement
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_status()
	{
		$status = null;
		$statuses = itemSeance::get_statuses();
		$statuses->set_index('id');

		if (!$this['availability']->is_empty())
		{
			$seanceStatus = array_unique(array_values($this['availability']->get()));
			// print'<pre>';print_r($seanceStatus);print'</pre>';

			foreach ($seanceStatus as $s)
			{
				if (!empty($s))
				{
					$keys[] = $statuses[$s]['key']->get();
				}
			}
			$statuses->set_index('key');

			switch (true)
			{
				case count($keys) == 1:
					$status = $statuses['seancestatus_'.$keys[0]];
					break;
				case in_array('open', $keys):
					$status = $statuses['seancestatus_open'];
					break;
				case in_array('last', $keys):
					$status = $statuses['seancestatus_last'];
					break;
				case in_array('telephone', $keys):
					$status = $statuses['seancestatus_telephone'];
					break;
				case in_array('soon', $keys):
					$status = $statuses['seancestatus_soon'];
					break;
			}
		}

		return $status;
	}
/**
 * Obtenir la liste des recommandatations
 *
 * @return	bunch  la liste des recomandations
 * @access	public
 */
	public function get_recommdantation()
	{
		$reco = new bunch();
		// liste remplie par l'admin
		if (!$this['groupevent']->is_empty())
		{
			$reco->get_by_nickname($this['groupevent']->get());
		}
		// reco automatique à partir des tags
		elseif(!$this['tag']->is_empty())
		{
			// extraction des ids des tags
			$tags = $this['tag']->get();
			$ids = array_map(function($tag)
			{
				$tmp = explode('_', $tag);
				return $tmp[1];
			}, $tags);
			// print'<pre>';print_r($ids);print'</pre>';
			// recherche des events liés
			$q = 'SELECT DISTINCT(itemid) FROM _rel WHERE item = "event" AND itemid != '.$this['id']->get().' AND rel = "tag" AND relid IN ('.implode(',', $ids).')';
			$db = database::connect();
			$r = $db->query($q);
			$param = array(
				'limit()' => 3,
				'start' => '> '.date('Y-m-d H:i:s'),
				'order()' => 'start'
			);
			foreach ($r['data'] as $value)
			{
				$param['id'][] = $value['itemid'];
			}
			$reco->get('event', $param);
		}
		// retour
		return $reco;
	}
/**
 * Affichage du push de l'event
 *
 * @return	bunch  Retourne le bunch des séances de l'événement
 * @access	public
 */
	public function get_push()
	{
		$app = app('content', '/push/event', array('item' => $this));
		return $app->__tostring();
	}


  public function get_box_image()
  {
    switch($this->isAlone)
    {
      case false:
        return $this['boximage']->unfold()[0]->thumbnail(380, 380);
        break;
      case true:
        return $this['mainimage']->unfold()[0];
        break;
    }
  }

    public function has_box_image(){
        return $this->isAlone ? $this['mainimage']->is_empty() : $this['boximage']->is_empty();
    }
/**
 * Affichage d'un abstract de l'event
 *
 * @return	bunch  Retourne le bunch des séances de l'événement
 * @access	public
 */
	public function __tostring()
	{
		$app = app('content', '/season/box', array('event' => $this));
		return $app->__tostring();
	}
}
?>
