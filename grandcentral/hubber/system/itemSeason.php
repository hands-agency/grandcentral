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
		print'<pre>';print_r($this);print'</pre>';
		return $this;
	}
/**
 * Obtenir la liste de tous les événements d'une saison, filtrable par tag
 *
 * @param	mixed  Catégorie des événements
 * @return	bunch  Retourne le bunch des events
 * @access	public
 * @static
 */
	public function get_events($params = array())
	{
		$p = array(
			'season' => $this->get_nickname(),
			'order()' => 'start'
		);
		foreach ($params as $key => $value)
		{
			$p[$key] = $value;
		}
		$events = i('event', $p);
		$datas = $events->data;
		
		for ($i=0; $i < $events->count; $i++)
		{
			if ($events[$i]->is_disabled())
			{
				$tmp = $events[$i];
				array_push($datas, array_shift($datas));
			}
		}
		$events->data = $datas;
		
		return $events;
	}
/**
 * Obtenir la liste de tous les séances d'une saison
 *
 * @return	bunch  Retourne le bunch des events
 * @access	public
 * @static
 */
	public static function get_seances()
	{
		
	}
}
?>