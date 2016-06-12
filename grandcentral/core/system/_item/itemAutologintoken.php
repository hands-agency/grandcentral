<?php

class itemAutologintoken extends _items
{
	const COOKIE_NAME = 'gca';
	const DATE_FORMAT = 'Y-m-d h:i:s';
	const EXPIRE = 100; // days

	public function __construct($env = env)
	{
		$env = 'site';
		parent::__construct($env);
		$this['key']->database_get();
	}

	// Generate token
	public function generate_token()
	{
		$salt = defined('SITE_SALT') ? SITE_SALT : 'Gr@nDc€nTrAL-HHaN$ds';
		$salt .= date(self::DATE_FORMAT).$this['key']->get();
		return md5($salt.$this['key']->get()).md5($this['key']->get().$salt);
	}

	public function save()
	{
		$this->set_cookie();
		parent::save();
	}

	public function set_cookie()
	{
		$this['token'] = $this->generate_token();
		setcookie(self::COOKIE_NAME, $this['token'], time() + (self::EXPIRE * 24 * 60 * 60), '/');
		$this['end'] = date(self::DATE_FORMAT , time() +  (self::EXPIRE * 24 * 60 * 60));
	}

	public function delete_cookie()
	{
		setcookie(self::COOKIE_NAME, '', time()-1, '/');
	}

}

?>
