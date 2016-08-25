<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemService extends _items
{
/**
 * Détermine la categorie de service contenant le service
 *
 * @access	public
 */
	public function get_category()
	{
		//
		$category = i('servicecategory', ['service' => $this->get_nickname()]);
		return $category;

	}
}
?>
