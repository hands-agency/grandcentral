<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemPartner extends _items
{
/**
 * Sauvegarde et remplissage auto
 *
 * @access	public
 */
	public function save()
	{
		// capeb d'apartenance
		if ($this['position']->is_empty())
		{
			$this['position'] = 100;
		}
		// sauvegarde
		parent::save();

    return $this;
	}
}
?>
