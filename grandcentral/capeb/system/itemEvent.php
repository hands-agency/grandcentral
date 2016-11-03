<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemEvent extends _items
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
		// sauvegarde
		parent::save();

    return $this;
	}
}
?>
