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
/**
 * Grab an item and put it in the workflow
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function grab($item, $status)
	{
	//	Our original item
		$this['item'] = $item->get_table();
		$this['original'] = $item->get_nickname();
	//	The item data
		$this['data'] = $item;
	//	The status
		$this['status'] = $status;

	//	Save
		$this->save();
		
	//	Do some clean up
		/* todo */
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