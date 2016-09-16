<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemNews extends _items
{
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
		foreach ($response['data'] as $value) {
			$data[$value['created_month']] = $value['created_month'];
		}

    return $data;
	}
}
?>
