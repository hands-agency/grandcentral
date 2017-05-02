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
	public function get_events()
	{
		// recherche dans le champ casting
		$q = 'SELECT `event`.`id` FROM `event` WHERE `event`.`casting` LIKE "%['.$this['id']->get().']%" AND `event`.`status` = "live";';
		$db = database::connect();
		$r = $db->query($q);
		$ids = null;
		foreach ($r['data'] as $event)
		{
			$ids[] = $event['id'];
		}
		// recherche dans le champ en vedette
		$q = 'SELECT `_rel`.`itemid` AS `id` FROM `_rel` WHERE `_rel`.`item` = "event" AND `_rel`.`rel` = "artist" AND `_rel`.`relid` = '.$this['id']->get().';';
		$db = database::connect();
		$r = $db->query($q);
		foreach ($r['data'] as $event)
		{
			$ids[] = $event['id'];
		}
		// return a bunch of event
		$events = new bunch();
		if (count($ids) > 0)
		{
			$p = array(
				'id' => $ids,
				'order()' => 'start desc'
			);
			$events->get('event', $p);
		}
		return $events;
	}
}
?>