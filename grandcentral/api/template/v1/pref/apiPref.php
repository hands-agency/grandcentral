<?php
/**
 * The generic api of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class apiPref extends _apis
{
/**
 * Request
 * @param string The method
 * @access	public
 */
	public function request($request)
	{
	//	Execute method depending of request
		switch ($request)
		{
			case 'get':
			//	Map the hash
				$this->map_hash(array('pref', 'key'));
			//	Call
				$this->$request($this->param['pref'], $this->param['key']);
				break;
			case 'post':
			//	Map the hash
				$this->map_hash(array('pref', 'key', 'value'));
			//	Call
				$this->$request($this->param['pref'], $this->param['key'], $this->param['value']);
				break;
		}
	}

/**
 * Get
 * @access	public
 */
	public function get($pref, $key)
	{
		$data = $_SESSION['user']['pref']->get();
	//	Store the pref
   		if (isset($data[$pref][$key]))
		{
		//	Meta
			$this->result['meta'] = array(
				'status' => 'success',
			);
		//	Data
			$this->result['meta'] = array(
				'pref' => $pref,
				'key' => $key,
				'value' => $_SESSION['user']['pref'][$pref][$key],
			);
   		}
//	Empty pref
	else
	{
		//	Meta
			$this->result['meta'] = array(
				'status' => 'fail',
			);
		}
	}

/**
 * Post
 * @access	public
 */
	public function post($pref, $key, $value)
	{
	//	Store the pref
		$_SESSION['user']['pref'][$pref] = array($key => $value);
		$_SESSION['user']->save();

	//	Meta
		$this->result['meta'] = array(
			'status' => 'success',
		);
	}
}
?>