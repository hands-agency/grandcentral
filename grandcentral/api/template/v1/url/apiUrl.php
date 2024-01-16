<?php
/**
 * Handle items
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class apiUrl extends _apis
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
				$this->map_hash(array('item', 'itemid'));
			//	Call
				$this->$request($this->param['item'], $this->param['itemid']);
				break;
		}
	}
/**
 * Get one or several items
 * @param string	The item you want to get (cast)
 * @param int	An optional item id	to get
 * @arg	param	array	An associated array (param[status]=live&amp;param[system]=true)
 * @arg	field	string	A comma separated list of fields for filtering the returned data (field=id,key,title)
 * @access	public
 */
	public function get($item, $itemid = null)
	{
	//	Some vars
		$d = array();
	
	//	Transform commas into array
		if (isset($_GET['field']))
		{
			$_GET['field'] = explode(',', $_GET['field']);
		}
	//	Do we have an id, params or nothing?
		if (isset($_GET['param'])) $p = $_GET['param'];
		else if (isset($this->param['itemid'])) $p = array('id' => $this->param['itemid']);
		else $p = null;

	//	Get one item
		$data = i($_GET['item'], $_GET['itemid']);
		
		
	//	Meta
		$this->result['meta'] = array(
			'status' => 'success'
		);
		$this->result['data'] = (string) $data['url'];
	}
}
?>