<?php
/**
 * TDC Event object
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemSeason extends _items
{
/**
 * Deviner la saison en cours
 *
 * @return	itemSeason  Lui-même
 * @access	public
 * @static
 */
	public function guess()
	{
		$this->get(array(
			'order()' => 'title desc',
			'limit()' => 1
		));
		return $this;
	}
/**
 * Sauvegarder en faisant suivre le status des events liés
 *
 * @param	mixed  Catégorie des événements
 * @return	bunch  Retourne le bunch des events
 * @access	public
 * @static
 */
	public function save()
	{
		parent::save();
		// change history value
		foreach ($this->get_events() as $event)
		{
			if ($event['history']->get() != $this['history']->get())
			{
				$event['history'] = $this['history']->get();
				$event->save();
			}

		}
	}
/**
 * Obtenir la liste des events de la saison
 *
 * @param	mixed  Catégorie des événements
 * @return	bunch  Retourne le bunch des events
 * @access	public
 * @static
 */
	public function get_events()
	{
		$events = new bunch(null, null, 'site');
		$events->get('event',array(
			'season' => $this->get_nickname(),
			'order()' => 'start ASC'
		));
		return $events;
	}
}
?>
