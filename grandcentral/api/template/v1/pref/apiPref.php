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
 * Post
 * @access	public
 */
	public function post()
	{
		$pref = $this->param['data']['pref'];
   		$value = array($pref[1] => $pref[2]);
   		$_SESSION['user']['pref'][$pref[0]] = $value;
	}
/**
 * Return the api data in json
 * @access	public
 */
	public function json()
	{
		return json_encode('success');
	}
}
?>