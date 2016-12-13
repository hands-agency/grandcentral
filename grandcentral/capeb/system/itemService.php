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
 * Sauvegarde et remplissage auto
 *
 * @access	public
 */
	public function save()
	{
		// capeb d'apartenance
		if ($this['capeb']->is_empty())
		{
			$national = i('capeb',itemCapeb::FALLBACK);
			$this['capeb']->set($national->get_nickname());
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
	public function get_category()
	{
		$category = i('servicecategory');
		$categories = i('servicecategory',all)->set_index('key');
		$capeb = $_SESSION['capeb'];
		foreach ($categories as $cat)
		{
			$key = (string) $cat['key'];
			if (isset($capeb[$key]) && in_array($this->get_nickname(), $capeb[$key]->get()))
			{
				return isset($categories['servicecategory_'.$key]) ? $categories['servicecategory_'.$key] : $category;
			}
		}

		return $category;

	}
/**
 * Retourne le référent du service
 *
 * @access	public
 */
	public function get_referent()
	{
		$referent = i('referent');
		$referent->get(array(
			'service' => $this->get_nickname(),
			'capeb' => $_SESSION['capeb']->get_nickname()
		));
		return $referent;

	}
/**
 * Retourne le guide associé au service
 *
 * @access	public
 */
	public function get_guides()
	{
		$guides = new bunch();
		if (isset($_SESSION['capeb'][$this['key']->get()]))
		{
			$guides = $_SESSION['capeb'][$this['key']->get()]->unfold();
		}
		return $guides;

	}
}
?>
