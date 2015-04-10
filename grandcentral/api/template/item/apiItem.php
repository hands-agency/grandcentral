<?php
/**
 * The generic api of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class apiItem
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
 * Get
 * @access	public
 */
	public function get()
	{
		$this->result = (empty($this->param)) ? i($this->item, all) : i($this->item, $this->param);
	}
/**
 * Post
 * @access	public
 */
	public function post()
	{
	//	New object or old one
		$this->result = (isset($this->data['id'])) ? i($this->item, $this->data['id']) : i($this->item);
	//	Loop through data
		foreach ($this->data as $key => $value) $this->result[$key] = $value;
		$this->result->save();
	}
/**
 * Return the api data in json
 * @access	public
 */
	public function json()
	{
		return $this->result->json();
	}
}
?>