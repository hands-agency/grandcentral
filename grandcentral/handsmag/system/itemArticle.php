<?php
/**
 * Projects
 *
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemArticle extends _items
{
	protected static $topics;
/**
 * Save item into database and sync with the magazine
 *
 * @access  public
 */
	public function save()
	{
		// recherche du magazine lié avec le présent article
		$mag = i('magazine');
		$mag->get(array(
			'article' => $this->get_nickname()
		));

		if ($mag->exists() && $mag->get_nickname() != $this['magazine']->get())
		{
			$q = 'DELETE FROM `_rel` WHERE `item` = "magazine" AND `itemid` = '.$mag['id'].' AND `rel` = "article" AND `relid` = '.$this['id'];
			$db = database::connect('site');
			$db->query($q);
		}

		if (!$this['magazine']->is_empty())
		{
			$current = $this['magazine']->unfold();
			$current['article']->add($this->get_nickname());
			$current->save();
		}

		parent::save();
	}
/**
 * Format date for display
 *
 * @access  public
 */
	public function get_topic()
	{
		if (empty(self::$topics))
		{
			self::$topics = i('topic', all)->set_index('id');
		}
		$topic = !$this['topic']->is_empty() ? self::$topics[$this['topic']->get()] : i('topic');
		return $topic;
	}
}
?>
