<?php
/**
 * News object
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemNews extends _items
{
/**
 * Sauvegarde et remplissage auto
 *
 * @access	public
 */
	public function save()
	{
		// capeb d'apartenance
		if ($this['capeb']->is_empty())
		{
			$national = i('capeb','national');
			$this['capeb']->set($national->get_nickname());
		}
		// date par défaut
		if ($this['date']->is_empty())
		{
			$this['date'] = date('Y-m-d h:i:s');
		}
		// sauvegarde
		parent::save();

    return $this;
	}
/**
 * Détermine la categorie de service contenant le service
 *
 * @access	public
 */
	public static function get_months()
	{
		//
    $db = database::connect();
		$response = $db->query('SELECT DATE_FORMAT(date, "%Y-%m") AS created_month FROM news GROUP BY created_month ORDER BY created_month DESC');

		$data = [];
		foreach ($response['data'] as $value)
		{
			$data[$value['created_month']] = $value['created_month'];
		}

    return $data;
	}
}
?>
