<?php
/**
 * Handle items
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class apiItem extends _apis
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
			case 'post':
			case 'delete':
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

	//	Get one item, or all of the items
		$data = new bunch();
		$data->get($this->param['item'], $p);

	//	Format data as a uniform array
		foreach ($data as $i)
		{
		//	Open a tmp array for the item
			$tmp = array();
			
		//	If we filter the fields
			if (isset($_GET['field']))
			{
				foreach ($_GET['field'] as $field)
				{
					if (isset($i[$field])) $tmp[$field] = $i[$field]->get();
				}
			}
		//	Otherwise, store everything
			else
			{
				foreach ($i as $key => $value)
				{
					$tmp[$key] = $value->get();
				}
			}
		//	Add to the array
			$d[] = $tmp;
		}
		
	//	Meta
		$this->result['meta'] = array(
			'status' => 'success',
			'count' => $data->count,
			'item' => $item,
		);
	//	Data
		$this->result['data'] = $d;
	}
/**
 * Post an item
 * @param string	The item table you want to post on (cast)
 * @param int	An optional item id for updates (123)
 * @data	data	array	An associated array of data named after the item's table (item:"cast",cast:{status:"live"},test:true)
 * @access	public
 */
	public function post($item, $itemid = null)
	{
	//	Some vars
		$item = (isset($_POST['item'])) ? $_POST['item'] : trigger_error('Sorry, you need and item here', E_USER_ERROR);
		$data = (isset($_POST[$item])) ? $_POST[$item] : trigger_error('Sorry, you need some data here', E_USER_ERROR);
		$id = (isset($itemid)) ? $itemid : null;
		
	//	Use an old item or open a new one
		$i = ($id != null) ? i($item, $id) : i($item);

	//	Loop through data to update it
		foreach ($data as $key => $value) if (isset($i[$key])) $i[$key] = $value;
		
	//	Save!
		if (!isset($_POST['test'])) $i->save();
		
	//	Get the item in a array for return
		$daraArray = array();
		foreach ($i as $key => $value) $daraArray[$key] = $value->get();
		
	//	Meta
		$this->result['meta'] = array(
			'status' => 'success',
			'item' => $item,
		);
	//	Data
		$this->result['data'] = $daraArray;
	}
/**
 * Delete an item
 * @param string	The item table you want to delete (cast)
 * @param int	The item id (123)
 * @access	public
 */
	public function delete($item, $itemid)
	{
	//	Get the item
		$item = i($item, $itemid);
	//	Delete if that guy exists
		if ($item->exists() && $item['status']->get() == 'live')
		{
		//	"Delete"
			$item['status'] = 'trash';
			$item->save();
		//	Meta
			$this->result['meta'] = array(
				'status' => 'success',
			);
		}
		else
		{
		//	Meta
			$this->result['meta'] = array(
				'status' => 'fail',
			);
		}
	}
}
?>