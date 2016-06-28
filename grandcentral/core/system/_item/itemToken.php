<?php

class itemToken extends _items
{
	const DATE_FORMAT = 'Y-m-d h:i:s';
	protected $expire = 1; // days

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
		parent::save();
	}

}

?>
