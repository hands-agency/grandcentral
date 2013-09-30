<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
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
		// print'<pre>';print_r($this['title']);print'</pre>';
		$app = new app($this['app']['key'], $this['key'].'/'.$this['app']['template'], $this['app']['param']);
		return $app->__tostring();
	}
}
?>