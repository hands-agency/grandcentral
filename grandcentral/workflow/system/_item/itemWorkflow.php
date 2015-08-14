<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemWorkflow extends _items
{
	private $item;
	private $originalStatus = array('live', 'asleep');
	
/**
 * Enroll an item in the workflow
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function enroll($item, $status = null)
	{
	//	The status
		$this['status'] = $status;
		
	//	Our original item
		$this['item'] = $item->get_table();
		$this['original'] = $item->get_nickname();
	//	The item (the data in the workflow)
		$this->item = $this['data'] = $item;
		
	//	Clean the database
		$this->clean();
	}
	
/**
 * Tells you if this guy goes to the workflow or no
 *
 * @access  public
 */
	public function is_inflow()
	{
	//	Goes to the workflow...
		return (!$this['status']->get() OR in_array($this['status']->get(), $this->originalStatus)) ? false : true;
	}
	
/**
 * Save an item in the workflow
 *
 * @access  public
 */
	public function save()
	{
	//	Goes to the workflow...
		if ($this->is_inflow() === true) parent::save();
	//	...or just save the item
		else {$this->item->save();}
	}
	
/**
 * Clean the workflow of the copies of an item
 *
 * @access  public
 */
	public function clean()
	{
		if ($this['item'])
		{
			if (!$this['original']->is_empty())
			{
			//	Get all the other items in the workflow for this original
				$copies = i('workflow', array(
					'original' => $this['original']->get(),
				));
			//	Delete them
				foreach ($copies as $copy) $copy->delete();
			}
		}
	}
	
/**
 * Unleash a workflow item into the wild
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function unleash()
	{
	//	Some vars
		$original = i($this['original']);
		$data = json_decode($this['data']->get()[0]);
		
	//	Remplace the data of the original by the item in the workflow
		foreach ($data as $key => $value)
		{
			if ('id' != $key) $original[$key] = $value;
		}
		$original->save();
	}
}
?>