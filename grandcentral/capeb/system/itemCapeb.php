<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access public
 * @link		http://grandcentral.fr
 */
class itemCapeb extends _items
{
/**
 *
 *
 * @access public
 */
	public function get_url($page = 'home')
	{
		//
		if ($page != 'home') {
			if (isset($this['home']) && !empty($this['home'])) {
				return $this['home']['url']->get_url . '/' . $page;
			}
			else {
				return 'http://capeb.dev';
			}
		}
		else {
			if (isset($this['home']) && !empty($this['home'])) {
				return $this['home']['url']->get_url;
			}
			else {
				return 'http://capeb.dev';
			}
		}
	}

/**
 *
 *
 * @access public
 */
	public function get_name()
	{
		//
		return $this['shorttitle'];
	}

/**
 *
 *
 * @access public
 */
	public function create_cookie($value = 'nationale')
	{
		//
    setcookie('capeb', $value, time() + (3600 * 24 * 30), '/', '.', false, true);
	}

/**
 *
 *
 * @access public
 */
	public function redirect()
	{
		//
	}

/**
 *
 *
 * @access public
 */
	public function load()
	{
		//
    if (isset($_COOKIE['capeb']) && !empty($_COOKIE['capeb'])) {
      # code...
    }
    else {
      $this->create_cookie();
    }
	}

/**
 *
 *
 * @access public
 */
	public function get_news()
	{
		//
	}

/**
 *
 *
 * @access public
 */
	public function get_events()
	{
		//
	}

/**
 *
 *
 * @access public
 */
	public function get_services()
	{
		//
	}

/**
 *
 *
 * @access public
 */
	public function get_pres()
	{
		//
	}
}
?>
