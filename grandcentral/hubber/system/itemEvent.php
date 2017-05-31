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
	* Obtenir les artistes associé à l'événement
	*
	* @return	string  Retourne une chaine de caractères
	* @access	public
	*/
	// public function get_artist($field = 'casting') {
  //   $fielddata = $this[$field];
  //   $roles = [];
  //   foreach ($fielddata as $data)
  //   {
  //     preg_match('/\d+/', $data['artist'], $idArray);
  //     $id = $idArray[0];
  //
  //     $roles[$id] = [
  //       'nickname' => 'artist_'.$id,
  //       'role' => new attrI18n($data['role'])
  //     ];
  //   }
  //
  //   $artists = i('artist', [
  //     'id' => array_keys($roles),
  //     'order()' => 'inherit(id)',
  //     'status' => ['live','asleep']
  //   ])->set_index('id');
  //
  //   foreach ($roles as $role)
  //   {
  //     $artist = $artists[$role['nickname']];
  //     $artist['role'] = $role['role'];
  //     $artists[$role['nickname']] = $artist;
  //   }
  //
  //   return $artists;
  // }
  public function get_artist($field = 'casting') {
    $fieldData = isset($this[$field]) && !$this[$field]->is_empty() ? $this[$field] : array();
    $ids = [];
    $datas = [];
    foreach ($fieldData as $data) {
      preg_match('/\[(\d*)\]/', $data['artist'], $idArray);
      if (!empty($idArray)) {
        $ids[] = $idArray[1];
        $datas['artist_'.$idArray[1]] = $data;
      }
      else {
        $datas[] = $data;
      }
    }

    if (!empty($ids)) {
      $artists = i('artist', [
        'id' => $ids,
        'order()' => 'inherit(id)',
        ])->set_index('id');

        foreach ($artists as $artist) {
          $nickname = $artist->get_nickname();
          if (isset($datas[$nickname])) {
            $datas[$nickname]['artist'] = $artist->get_display_name();
            $datas[$nickname]['url'] = $artist['url'];
            $datas[$nickname]['imagepush'] = $artist['imagepush'];
          }
        }
    }

    return $datas;
  }

  /**
	* Obtenir les séances de l'événement
	*
	* @return	string  Retourne une chaine de caractères
	* @access	public
	*/
	public function get_seance() {
    $seances = json_decode($this['seance']->get(), true);

    return $seances;
  }

  public static function get_seance_date($date, $nbDays, $diff = '') {
		$dateNow = is_string($date) ? new DateTime($date) : $date;
		$dateFirst = is_string($diff) && $diff != '' ? $dateNow->modify($diff) : clone $dateNow;
		$dateTemp = clone $dateFirst;
		$data = [];

		$db = database::connect('site');
		$q = 'SELECT `title`, `shortdescr`, `start`, `end`, `seance`, `place`, `url` FROM `event` WHERE ';
		$where = [];
		for ($i=0; $i < $nbDays; $i++)
		{
			$where[] = '(`start` <= "'.$dateTemp->format('Y-m-d').'" AND `end` >= "'.$dateTemp->format('Y-m-d').'")';
			$data[$dateTemp->format('Y-m-d')] = [];
			$dateTemp->modify('+1 day');
		}
		$q .= implode(' OR ', $where);
		$results = $db->query($q);

		foreach ($results['data'] as $value)
		{
			$event = i('event');
			$event['seance'] = $value['seance'];
			$event['title'] = json_decode($value['title'], true);
			$event['shortdescr'] = json_decode($value['shortdescr'], true);
      $event['place'] = $value['place'];
      $event['url'] = json_decode($value['url'], true);
			$seances = $event->get_seance();

			if (!empty($seances)) {
        foreach ($seances as $seance) {
  				unset($seance['category']);
  				$dateSeance = new DateTime($seance['date']);
  				$dateSeance->setTime(0, 0, 0);
          $place = i($event['place']);

  				$seance['title'] = (string) $event['title'];
  				$seance['descr'] = (string) $event['shortdescr'];
  				$seance['place'] = (string) $place['title'];
  				$seance['button'] = trim(get_snippet('content', '_snippet/button/button-status', ['seance' => $seance]));
          $seance['event_url'] = (string) $event['url'];

  				if (isset($data[$dateSeance->format('Y-m-d')])) {
  					$data[$dateSeance->format('Y-m-d')][] = $seance;
  				}
  			}
			}
		}

		ksort($data);

    return $data;
	}
}
?>
