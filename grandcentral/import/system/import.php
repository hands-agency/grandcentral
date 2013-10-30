<?php
/**
 * The group item of Café Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class import
{
	protected $url;
	public $equiv;
	public $data;
	
/**
 * Class constructor
 *
 * @param	string  only site
 * @access	public
 */
	public function __construct($url, $item, $equiv)
	{
	//	Some vars
		$this->url = $url;
		$this->item = $item;
		$this->equiv = $equiv;
	}
	
/**
 * Returns the data of a specific cast
 *
 * @param	int 
 * @access	public
 */
	public function get_data()
	{
		$this->data = simplexml_load_file($this->url, null, LIBXML_NOCDATA);
	}
	
/**
 * Returns the data of a specific cast
 *
 * @param	int 
 * @access	public
 */
	public function save()
	{
		// print '<fieldset class="debug"><legend>'.__FUNCTION__.'() in '.__FILE__.' line '.__LINE__.'</legend><pre>';print_r($this->data);print'</pre></fieldset>';
		foreach ($this->data as $data)
		{
		//	Create the new object
			$item = cc($this->item);
			
		//	Todo
			if ((string) $data->etat == 'active') $item['status'] = 'live';
			else $item['status'] = 'asleep';
			
		//	Loop throug the attributes
			foreach ($this->equiv as $newField => $oldField)
			{
				$value = trim((string) $data->$oldField);
				
				if ($newField == 'photo') $value = array(array('url' => 'image/photo/'.$value.'.jpg'));
				if ($newField == 'text') $value = json_encode(array('data' => array('type' => 'text', 'data' => strip_tags($value))));
				
				if (isset($data->$oldField)) $item[$newField] = $value;
			}
		//	Save item
			$item->save();	
		}
	}
}
?>