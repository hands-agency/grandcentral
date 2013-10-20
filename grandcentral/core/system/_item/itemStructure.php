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
	public function database_set($data)
	{
		parent::database_set($data);
		$this->_attr = $this['attr']->get();
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
 * Save item into database
 *
 * @access  public
 */
	public function save()
	{
		$this->_prepare_attr();
		parent::save();
	}
/**
 * Build queries to insert an item
 *
 * @access  protected
 */
	protected function _prepare_attr()
	{
		$attrs = $this->data['attr']->get();
	//	add Id attribute
		if (!isset($attrs['id']))
		{
			$attrs = array_reverse($attrs, true);
			$attrs['id'] = array(
				'key' => 'id',
				'type' => 'id',
				'title' => 'The unique identifier'
			);
			$attrs = array_reverse($attrs, true);
		}
		else
		{
			$attrs['id']['key'] = 'id';
			$attrs['id']['type'] = 'id';
		}
	//	add Key attribute
		if (!isset($attrs['key']))
		{
			$attrs['key'] = array(
				'key' => 'key',
				'type' => 'key',
				'title' => 'The key'
			);
		}
		else
		{
			$attrs['key']['key'] = 'key';
			$attrs['key']['type'] = 'key';
		}
	//	add Title attribute
		// if (!isset($attrs['title']))
		// {
		// 	$attrs['title'] = array(
		// 		'key' => 'title',
		// 		'type' => 'string',
		// 		'title' => 'Title',
		// 		'max' => 255
		// 	);
		// }
	
	//	add Url attribute
		if (!isset($attrs['url']) && $this['hasurl']->get() === true)
		{
			$attrs['url'] = array(
				'key' => 'url',
				'type' => 'url',
				'title' => 'Url'
			);
		}
	//	add Created attribute
		if (!isset($attrs['created']))
		{
			$attrs['created'] = array(
				'key' => 'created',
				'type' => 'created',
				'title' => 'Created Datetime'
			);
		}
	//	add Updated attribute
		if (!isset($attrs['updated']))
		{
			$attrs['updated'] = array(
				'key' => 'updated',
				'type' => 'updated',
				'title' => 'Updated Datetime'
			);
		}
	//	add Updated attribute
		if (!isset($attrs['status']))
		{
			$attrs['status'] = array(
				'key' => 'status',
				'type' => 'status',
				'title' => 'Status'
			);
		}
		// print'<pre>';print_r($attrs);print'</pre>';
		$this->data['attr']->set($attrs);
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
		$indexes = array();
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
		$db->stack('CREATE TABLE IF NOT EXISTS `'.$db->get_name().'`.`'.$this['key'].'` ('.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $columns).','.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $indexes).''.PHP_EOL.') ENGINE=InnoDB DEFAULT CHARSET='.database::charset.' COLLATE='.database::collation.'');
		
		// print'<pre>';print_r($db->_spooler);print'</pre>';
		// exit;
	}
/**
 * Build queries to update an item
 *
 * @access  protected
 */
	protected function _update()
	{
		// print'<pre>';print_r($_POST);print'</pre>';
	//	création de l'index des colonnes
		$this->columns = array_keys($this['attr']->get());
	//	insert data into table structure
		parent::_update();
	//	conect to db
		$db = database::connect($this->get_env());
	//	on détermine ce qui change
		// $change = array_intersect_key($this['attr'], $this->attrs);
		// $add = array_diff_key($this['attr'], $this->attrs);

	//	ADD & CHANGE
		$columns = array();
		$indexes = array();
		// print'<pre>';print_r($this['attr']);print'</pre>';
		foreach ($this['attr']->get() as $key => $attr)
		{
			if (!isset($attr['type']) || empty($attr['type'])) trigger_error('Attributes <strong>'.$key.'</strong> can not have an empty type.', E_USER_ERROR);
			if ($attr['type'] != 'rel')
			{
				$attrClass = 'attr'.ucfirst($attr['type']);
				$attr = new $attrClass(null, $attr);
				if (isset($this['attr'][$key]) && isset($this->_attr[$key]))
				{
					$columns[] = 'CHANGE `'.$key.'` '.$attr->mysql_definition().$this->_column_position($this['attr'][$key]['key']);
				}
				else
				{
					$columns[] = 'ADD '.$attr->mysql_definition().$this->_column_position($this['attr'][$key]['key']);
					if ($attr->mysql_index_definition() !== null)
					{
						$indexes[] = $attr->mysql_index_definition();
					}
				}
			}
		}
		// print'<pre>';print_r($columns);print'</pre>';
	//	DROP
		// print PHP_EOL.'AVANT : '.PHP_EOL;print_r($this->_attr);print'------------------------------------------------------------------------------------------------------------';
		// print PHP_EOL.'POST : '.PHP_EOL;print_r($this['attr']->get());print'------------------------------------------------------------------------------------------------------------';
		$drop = array_diff_key($this->_attr, $this['attr']->get());
		// print'<pre>';print_r($drop);print'</pre>';
		foreach ($drop as $key => $attr)
		{
			if ($attr['type'] != 'rel')
			{
				$columns[] = 'DROP `'.$attr['key'].'`';
			}
		}
	//	add query to the spooler
		// $db->stack('ALTER TABLE `'.$db->get_name().'`.`'.$this->_key.'` '.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $columns).','.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $indexes).''.PHP_EOL.'');
		$db->stack('ALTER TABLE `'.$db->get_name().'`.`'.$this->_key.'` '.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $columns));
		
		// print'<pre>';print_r($db->_spooler);print'</pre>';
		// exit;
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
		$db->stack('DROP TABLE IF EXISTS `'.$db->get_name().'`.`'.$this->_key->get().'`');
		// print'<pre>';print_r($db->_spooler);print'</pre>';
		// 		exit;
    }
/**
 * ALTER - Obtenir la définition mysql de la position d'une colonne
 *
 * @param	string 	la clé de l'attribut
 * @return	string 	la définition mysql de la position de l'attribut
 * @access	private
 */
	private function _column_position($key)
	{
		
		$pos = array_search($key, $this->columns);
		// echo $key.PHP_EOL;
		// print'<pre>pos '.$key.' : ';print_r($pos);print'</pre>';
		$position = ($pos == 0) ? 'FIRST' : 'AFTER `'.$this->columns[$pos - 1].'`';
		return ' '.$position;
	}
}
?>