<?php
/**
 * TDC Event object
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemSeance extends _items
{
/**
 * Obtenir l'identifiant secutix
 *
 * @return	string  l'identifiant secutix
 * @access	public
 */
	public function get_secutix_id()
	{
		return mb_substr($this['key']->get(), 1);
	}
/**
 * Savoir si la séance à un prix spécial pour une des cartes membres
 *
 * @return	bool	true ou false
 * @access	public
 */
	public function has_card($card)
	{
		return isset($this['carte']->get()[$card]);
	}
/**
 * Obtenir l'url secutix de la seance
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_secutix_url()
	{
		$is_structure = SecutixUser::isStructure();
		if (!defined('SITE_VERSION')) define('SITE_VERSION', 'fr');

		if($is_structure)
		{
			$event_id = $this['event']->unfold()->get_secutix_id();
			return Secutix::url_shop().'/option/event/detail?lang='.SITE_VERSION.'&productId='.$event_id;
		}
		else
		{
			return Secutix::url_shop().'/selection/event/seat?lang='.SITE_VERSION.'&perfId='.$this->get_secutix_id();
		}
	}
/**
 * Retourne la plage de prix de la seance
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_price()
	{
		return cst('SEANCE_PRICE', array('price' => $this['prixmin']));
	}
/**
 * Obtenir la bouton réserver de la séance
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_button()
	{
		$status = $this->get_status();
		// print'<pre style="font-size:11px">';print_r($status);print'</pre>';
		// print'<pre>';print_r($this['dispo']['availability']);print'</pre>';
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
				if (!$status['buttonlink']->is_empty())
				{
					$from[] = '[seanceid]';
					$to[] = $this->get_secutix_id();
					if (mb_strstr($status['buttonlink'], '[eventid]'))
					{
						$from[] = '[eventid]';
						$to[] = $this['event']->unfold()->get_secutix_id();
					}
					$version = i('version',current)['lang'];
					$button .= '<a href="'.str_replace($from, $to, $status['buttonlink']).'&lang='.$version.'" class="btn btn-green" style="background-color:#'.$status['buttoncolor'].'">'.$status['buttontext'].'</a>';
				}
				else
				{
					$button .= '<span class="btn" style="background-color:#'.$status['buttoncolor'].'">'.$status['buttontext'].'</span>';
				}

			}
			//$button = '<span class="full">'.t('Le contingent internet est désormais complet. Des places à visibilité réduite restent disponibles au 01 40 28 28 40 et aux guichets.').'</span>'
			//$button = ($this['dispo']['availability'] != 0) ? '<a href="'.$this->get_secutix_url().'" class="btn btn-green">'.cst('RÉSERVER').'</a>' : '<span class="full">'.t('Le contingent internet est désormais complet. Des places à visibilité réduite restent disponibles au 01 40 28 28 40 et aux guichets.').'</span>';
			return $button;
		}
	}
/**
 * Savoir si la séance la date de la séance n'est pas encore passée
 *
 * @return	bool  true ou false
 * @access	public
 */
	public function is_disabled()
	{
		return date('Y-m-d H:i:s') > $this['date'] ? true : false;
	}
/**
 * Savoir si la séance a encore des places disponibles
 *
 * @return	bool  true ou false
 * @access	public
 */
	public function is_available()
	{
		return $this['dispo']['availability'] != 0 ? true : false;
	}
/**
 * Savoir si la séance a été créée chez Secutix
 *
 * @return	bool  true ou false
 * @access	public
 */
	public function is_secutix()
	{
		return mb_substr($this['key']->get(), 0, 1) == 's' ? true : false;
	}
/**
 * Savoir si la date d'ouverture de ventes des billets est passée
 *
 * @return	bool  true ou false
 * @access	public
 */
	public function is_salable()
	{
		return $this['salestart']->is_empty() || (!$this['salestart']->is_empty() && $this['salestart']->diff(date('Y-m-d H:i:s'))->format("%R") == '+') ? true : false;
	}
/**
 * Obtenir la date formatée pour l'affichage
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_formated_date()
	{
		$hour = $this['date']->format('i') == '00' ? $this['date']->format('H\h') : $this['date']->format('H\hi');
		return '<span>'.cst('DAY_'.$this['date']->format('N')).' '.$this['date']->format('d').' '.cst('MONTH_'.$this['date']->format('n')).' '.$this['date']->format('Y').'</span> '.$hour.'';
	}
/**
 * Sauvegarde une séance et modifie l'événement lié en conséquence
 *
 * @access	public
 */
    public function save()
	{
		// on récupère le status de l'event
		$status = $this->get_status();
		if (is_a($status, '_items'))
		{
			$status = $status->get_nickname();
		}
		$this['availability']->set($status);
		// on sauvegarde aussi le status de la seance dans le champ availability de l'event
		$event = $this['event']->unfold();
		$event['availability'][$this['id']->get()] = $this['availability']->get();
		$event->save();

		parent::save();

		return $this;
    }
/**
 * Obtenir l'état actuel de la séance
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_status()
	{
		$statuses = self::get_statuses();
		$statuses->set_index('key');
		//print'<pre>';print_r($status);print'</pre>';
		if ($this['availability']->is_empty())
		{
			// print'<pre>';print_r('vide');print'</pre>';
			switch (true)
			{
				// la séance est passée
				case $this->is_disabled():
					$status = $statuses['seancestatus_old'];
					break;
				// la séance est en entrée libre
				case !$this->is_secutix():
					$status = $statuses['seancestatus_free'];
					break;
				// la séance n'est pas encore en vente
				case $this->is_available() && !$this->is_salable():
					$status = $statuses['seancestatus_soon'];
					break;
				// la séance a des dispos limitées et pas d'état
	 			case $this->is_available() && $this['dispo']['availabilityLevel'] == 'LIMITED':
					$status = $statuses['seancestatus_last'];
					break;
				// la séance a des dispos et pas d'état
				case $this->is_available():
					$status = $statuses['seancestatus_open'];
					break;
				// la séance a des dispos et pas d'état
				case !$this->is_available():
					$status = $statuses['seancestatus_closed'];
					break;
				default:
					$status = null;
					break;
			}
		}
		else
		{
			$current = $statuses->set_index('id')[$this['availability']->get()]['key']->get();
			$statuses->set_index('key');
			// print'<pre>';print_r($current);print'</pre>';
			switch (true)
			{
				// la séance est passée
				case $this->is_disabled():
					$status = $statuses['seancestatus_old'];
					break;
				// la séance n'est pas encore en vente
				case !$this->is_salable():
					$status = $statuses['seancestatus_soon'];
					break;
				// reinit si etat soon n'est plus valable
				case $this->is_salable() && $current == 'soon':
					$this['availability'] = null;
					$status = $this->get_status();
					break;
				// passage de l'état open à limited
	 			case $current == 'open' && $this['dispo']['availabilityLevel'] == 'LIMITED':
					$status = $statuses['seancestatus_last'];
					break;
				// passage à l'état close si plus de billet dispo
				case in_array($current, array('open', 'last', 'soon')) && !$this->is_available():
					$status = $statuses['seancestatus_closed'];
					break;
				// passage à l'état open si de nouveau des dispos
				case in_array($current, array('closed')) && $this->is_available():
					$status = $this['dispo']['availabilityLevel'] == 'LIMITED' ? $statuses['seancestatus_last'] : $statuses['seancestatus_open'];
					break;
				// sinon on garde l'état par défaut
				default:
					$status = $statuses['seancestatus_'.$current];
					break;
			}
		}

		return $status;
	}
/**
 * Obtenir la liste des états des séances
 *
 * @return	bunch	la liste des status de séance
 * @access	public
 */
	public static function get_statuses()
	{
		if (!registry::get('site', 'seance', 'status'))
		{

			$status = i('seancestatus', all, 'site');
			registry::set('site', 'seance', 'status', $status);
		}
		return registry::get('site', 'seance', 'status');
	}
}
?>
