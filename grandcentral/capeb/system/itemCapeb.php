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
		public function load()
		{
			//
	    $this->create_cookie($this['key']);
			$this->set_session($this);

			return $this->get_home_url();
		}

	/**
	 *
	 *
	 * @access public
	 */
		public static function init()
		{
			//
			$capeb = i('capeb');
			if (isset($_COOKIE['capeb']) && !empty($_COOKIE['capeb'])) {
				$cookie = $_COOKIE['capeb'];

				$capeb->create_cookie($cookie);
				$capeb->set_session(i('capeb', $cookie));

				return '';
			}
			else {
				$capeb->create_cookie();
				$capeb->set_session();

				return 'overlayed';
			}
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function get_key()
		{
			//
			return $this['key'];
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
		public function get_home_url()
		{
			//
				if (isset($this['homepage']) && $this['homepage']->is_empty()) {
					return '#';
				}
				else {
					return (string) $this['homepage']->unfold()['url'];
				}
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function redirect()
		{
			//
			header('Location: '.$this->get_home_url());
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function create_cookie($value = 'cnational')
		{
			//
	    setcookie('capeb', $value, time() + (3600 * 24 * 30), '/', '', false, true);
		}

	/**
	 *
	 *
	 * @access public
	 */
		public function set_session($capeb = 'cnational')
		{
			//
			$_SESSION['capeb'] = $capeb;
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
