<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class itemStructure extends _items
{
	protected $_key;
	protected $_attr;
	
/**
 * Fill the object with all his attributes
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function set_data($data)
	{
		$this->data = $data;
		$this->_attr = $data['attr'];
		$this->_key = $data['key'];
	}
	
/**
 * Check if the items of this structure have an url and can be requested
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function has_url($data)
	{
		return (isset($this->_attr->url)) ? true : false;
	}
/**
 * Build queries to insert an item
 *
 * @access  protected
 */
	protected function _insert()
	{
	//	insert data into table structure
		parent::_insert();
	//	conect to db
		$db = database::connect($this->get_env());
	//	create database
		$columns = array();
		foreach ($this['attr'] as $key => $attr)
		{
			if ($attr['type'] != 'rel')
			{
				$attrClass = 'attr'.ucfirst($attr['type']);
				$attr = new $attrClass(null, $attr);
				$columns[] = $attr->mysql_definition();
				if ($attr->mysql_index_definition() !== null)
				{
					$indexes[] = $attr->mysql_index_definition();
				}
			}
		}
	//	add query to the spooler
		$db->spool('CREATE TABLE IF NOT EXISTS `'.$db->get_name().'`.`'.$this['key'].'` ('.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $columns).','.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $indexes).''.PHP_EOL.') ENGINE=InnoDB DEFAULT CHARSET='.database::charset.' COLLATE='.database::collation.'');
		
		print'<pre>';print_r($db->_spooler);print'</pre>';
		exit;
	}
/**
 * Build queries to update an item
 *
 * @access  protected
 */
	protected function _update()
	{
	//	insert data into table structure
		parent::_update();
	//	conect to db
		$db = database::connect($this->get_env());
	//	on détermine ce qui change
		// $change = array_intersect_key($this['attr'], $this->attrs);
		// $add = array_diff_key($this['attr'], $this->attrs);
		// $drop = array_diff_key($this->attrs, $this['attr']);
	//	update database
		$columns = array();
		foreach ($this['attr'] as $key => $attr)
		{
			if ($attr['type'] != 'rel')
			{
				$attrClass = 'attr'.ucfirst($attr['type']);
				$attr = new $attrClass(null, $attr);
				if (isset($this['attr'][$key]) && isset($this->_attr[$key]))
				{
					$mysqltag = 'CHANGE `'.$key.'` ';
				}
				else
				{
					$mysqltag = 'ADD ';
				}
				$columns[] = $mysqltag.$attr->mysql_definition();
			}
		}
		foreach ($this->_attr as $key => $attr)
		{
			if ($attr['type'] != 'rel')
			{

			}
		}
	//	add query to the spooler
		$db->spool('ALTER TABLE `'.$db->get_name().'`.`'.$this->_key.'` '.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $columns));
		
		print'<pre>';print_r($db->_spooler);print'</pre>';
		exit;
	}
/**
 * Build queries to delete an item
 *
 * @access  protected
 */
	protected function _delete()
	{
	//	insert data into table structure
		parent::_delete();
	//	conect to db
		$db = database::connect($this->get_env());
	//	delete table
		$db->spool('DROP TABLE IF EXISTS `'.$db->get_name().'`.`'.$this->_key->get().'`');
		print'<pre>';print_r($db->_spooler);print'</pre>';
		exit;
    }
}
?>