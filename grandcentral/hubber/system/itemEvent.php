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
    $fieldData = $this[$field];
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
}
?>
