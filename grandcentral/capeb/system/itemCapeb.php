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
	public function get_home_url()
	{
		//
			if ($this['home']->is_empty()) {
				return '#';
			}
			else {
				return (string) $this['home']->unfold()[0]['url'];
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
