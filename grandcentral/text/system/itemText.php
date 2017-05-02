<?php
/**
 * The text item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemText extends _items
{
/**
 * Save item into database
 *
 * @access  public
 */
	public function save()
	{
		// Save first
		parent::save();

		// create or update section
		$section = i('section', $this['key']->get());
		$section['title'] = $this->get_table().' - '.$this['title'];
		$section['key'] = $this['key'];
		$section['zone'] = 'content';
		$section['app'] = array(
			'app' => 'text',
			'template' => '/text',
			'param' => array(
				'item' => serialize($this)
			)
		);
		$section->save();
	}
}
?>
