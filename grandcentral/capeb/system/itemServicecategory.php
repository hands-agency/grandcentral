<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemServicecategory extends _items
{
/**
 * retourne les services de la catégorie
 *
 * @access	public
 */
	public function get_services()
	{
		$capeb = $_SESSION['capeb'];
		$services = $capeb[$this['key']->get()]->unfold();
		return $services;
	}
/**
 * Retourne les référents de la catégorie
 *
 * @access	public
 */
	public function get_referents()
	{
		$referents = new bunch();
		$capeb = $_SESSION['capeb'];
		$services = $capeb[$this['key']->get()]->get();
		// get services ids
		if (!empty($services))
		{
			$ids = array_map(function($id)
			{
				return explode('_',$id)[1];
			}, $services);
			// query -> get referent id from relation table
			$q = 'SELECT `_rel`.`itemid` FROM `_rel` WHERE `_rel`.`item` = "referent" AND ((`_rel`.`key` = "service" AND `_rel`.`relid` IN ('.implode(',',$ids).')))';
			$db = database::connect();
			$r = $db->query($q);
			$ids = array_map(function($id)
			{
				return $id['itemid'];
			}, $r['data']);
			// get referent
			if (count($ids) > 0)
			{
				$referents->get('referent', array(
					'id' => $ids,
					'capeb' => $capeb->get_nickname(),
					'order()' => 'title ASC'
				));
			}
		}
		return $referents;

	}
/**
 * Retourne les documents de la catégorie
 *
 * @access	public
 */
	public function get_documents()
	{
		$documents = new bunch();
		$capeb = $_SESSION['capeb'];
		$services = $capeb[$this['key']->get()]->unfold();
		if ($services->count > 0)
		{
			$ids = array();
			foreach ($services->get_column('document') as $doc)
			{
				$ids = array_merge($ids, $doc);
			}
			// on ne retourne que les documents de la capeb nationale (118) et la capeb en session
			$documents->get_by_nickname($ids, array(
				'capeb' => array('capeb_118', $capeb->get_nickname())
			));
		}
		return $documents;

	}
}
?>
