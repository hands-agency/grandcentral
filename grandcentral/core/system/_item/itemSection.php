<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@cafecentral.fr>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemSection extends _items
{
/**
 * Display section
 *
 * @return	html code of the section
 * @access	public
 */
	public function __tostring()
	{
		$app = app($this['app']['app'], $this['app']['template'], $this['app']['param'], $this->get_env());
		master::bind_code($this['zone']->get(), $app->__tostring(), false, $this->get_nickname());
		return '';
	}
}
?>