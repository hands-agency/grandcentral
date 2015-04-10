<?php
/**
 * The generic api of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class apiPref
{
	public $api;
	public $template;
	public $item;
	public $param;
	public $data;
/**
 * Lorem
 * @access	public
 */
	public function __construct($p)
	{	
	//	Api (ie: api.json)
		if (isset($p['api'])) $this->api = $p['api'];
	//	Template (ie: pref)
		if (isset($p['template'])) $this->template = $p['template'];
	//	Item (ie: page)
		if (isset($p['item'])) $this->item = $p['item'];
	//	Param (ie array('save' => true))
		if (isset($p['param'])) $this->param = $p['param'];
	//	Data
		if (isset($p['data'])) $this->data = $p['data'];
	}
/**
 * Post
 * @access	public
 */
	public function post()
	{
   		$value = array($this->data['pref'][1] => $this->data['pref'][2]);
   		$_SESSION['user']['pref'][$this->data['pref'][0]] = $value;
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