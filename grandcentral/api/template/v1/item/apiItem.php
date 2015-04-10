<?php
/**
 * The generic api of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class apiItem extends _apis
{
/**
 * Get
 * @access	public
 */
	public function get()
	{
	//	Get the item(s)
		$this->result = (empty($this->param['itemid'])) ? i($this->param['item'], all) : i($this->param['item'], $this->param['itemid']);
	//	Get an attr or a rel
		if (isset($this->param['attr']))
		{
			// attr exists in object
			if (isset($this->result[$this->param['attr']]))
			{
				$this->result = $this->result[$this->param['attr']];
				
				if (isset($this->param['attrid']) && is_a($this->result, 'attrRel'))
				{
					//$this->result = 
				}
			}
			
			
		//	A rel
			// if (isset($this->param['attrid'])) $this->result = $this->result[$this->param['attr']]->unfold()[0];
		//	An attr
			// else $this->result = $this->result[$this->param['attr']];
		}
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