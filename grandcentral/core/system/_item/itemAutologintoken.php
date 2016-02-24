<?php 

class itemAutologintoken extends _items{

	protected $expiration = 186;

	public function __construct($env = env)
	{
		$env = 'site';
		parent::__construct($env);
	}

	// Generate token
	public function get_token()
	{
		$salt = 'Gr@nDc€nTrAL-HHaN$ds'.date('Y-m-d h:i:s').$this['key'];
		return md5($salt.$this['key']->get()).md5($this['key']->get().$salt);
	}

	public function save()
	{
		if ($this['token']->is_empty())
		{
			$this->new_cookie();
		}
		else
		{
			$this->set_cookie();
		}
		parent::save();
	}

	public function new_cookie()
	{
		$this['token'] = $this->get_token();
		setcookie('gc-autologin', $this['token'], time() + ($this->expiration * 24 * 60 * 60));
		$this['end'] = date('Y-m-d h:i:s' , time() +  ($this->expiration * 24 * 60 * 60));
	}

	public function set_cookie()
	{
		$this['token'] = $this->get_token();
		setcookie('gc-autologin', $this['token']);
	}

	public function delete_cookie()
	{
		setcookie('gc-autologin', $this['token'], time()-1);
		$this->delete();
	}

}

?>