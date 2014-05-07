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
	public function __construct($url, $item, $equiv, $populate = null)
	{
	//	Some vars
		$this->url = $url;
		$this->item = $item;
		$this->equiv = $equiv;
		$this->populate = $populate;
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
		//	Test
			$test = i($this->item, array('title' => trim((string) $data->titre)));
			if ($test->count()) $item = i($this->item, $test[0]['id']->get());
		//	Create the new object
			else $item = i($this->item);
			
		//	Todo
			if ((string) $data->etat == 'active') $item['status'] = 'live';
			else $item['status'] = 'asleep';
			
		//	Loop through the attributes to be imported
			foreach ($this->equiv as $newField => $oldField)
			{
				$add = true;
				$value = trim((string) $data->$oldField);
				
				if ($value)
				{
				//	Switch
					switch ($newField)
					{
						case 'id':
							$item[$newField]->set($value);
						//	$add = false;
							break;
						case 'photo':
							$value = array(array('url' => 'image/photo/'.$value.'.jpg'));
							break;
						case 'text':
						case 'txt':
							$value = json_encode(array('data' => array(array('type' => 'text', 'data' => array('text' => strip_tags($value))))));
							break;
						case 'tag':
							$value = explode(',', (string) $value);
								
							foreach ($value as $title)
							{
								$title = trim($title);	
								$rel = i('place', array('title' => $title));
								if ($rel->count()) $item['location']->add($rel[0]);
								$rel = i('people', array('title' => $title));
								if ($rel->count()) $item['people']->add($rel[0]);
							}
							$add = false;
							break;
						case 'issue':								
							$rel = i('issue', $value);
							$item['issue']->add($rel);
							$add = false;
							break;
							
					}
				//	Add Attr
					if (isset($data->$oldField) && $add) $item[$newField] = $value;	
				}
			}
			
		//	Loop through the attributes to be populated
			if ($this->populate)
			{
				foreach ($this->populate as $newField => $value)
				{
				//	Value or function
					if (substr($value, -2) == '()')
					{
						$function = substr($value, 0, -2);
						$value = $function($item);
					}
				
				//	Switch
					switch ($newField)
					{
						case 'password':
							$value = $item['password']->generate();
							break;
						default:
							$item[$newField] = $value;
							break;
					}
				}
			}
			
		//	Save item
			$item->save();	
		}
	}
}
?>