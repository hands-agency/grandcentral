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
		foreach ($this->data as $data)
		{
		//	Create the new object
			$item = cc($this->item);
			
		//	Todo
			if ((string) $data->etat == 'active') $item['status'] = 'live';
			else $item['status'] = 'asleep';
			
		//	Loop throug the attributes
			foreach ($this->equiv['attr'] as $newField => $oldField)
			{
				$value = trim((string) $data->$oldField);
				if ($newField == 'photo') $value = array('/image/photo/'.$value.'.jpg');
				if (isset($data->$oldField)) $item[$newField] = $value;
			}
			
		//	Loop throug the relations
			foreach ($this->equiv['rel'] as $newField => $oldField)
			{
			//	Check if the structure exists
				$structure = new structure($newField);
				if ($structure->exists())
				{
					$values = explode(',', (string) $data->$oldField);
				//	For each value...
					foreach ($values as $value)
					{
						if (!empty($value))
						{
						//	Check if the relation already exists
							$value = trim($value);
							$rel = cc($newField, array('title' => $value));
							if ($rel->count() == 0)
							{
							//	Create the new item
								$rel = cc($newField);
								$rel['title'] = $value;
								$rel['status'] = 'live';
								$rel->save();
							//	Add it as a rel to the current item
								$item->add_rel($newField, $newField.'_'.$rel['id']);
							}
						}
					}
				}
			}
		//	Save item
			$item->save();
		}
	}
}
?>