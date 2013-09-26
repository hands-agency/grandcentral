<?php
/**
 * Handles data fetched in the database
 *
 * a data = one line in the database
 * 
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
abstract class _items implements ArrayAccess, Iterator
{
	protected $env;
	protected $table;
	public $data;
	
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  admin ou site (environnement courant par défaut)
 * @access	public
 */
	public function __construct($env = env)
	{
		$this->table = mb_substr(mb_strtolower(get_called_class()), 4);
		$this->env = $env;
		
	//	création de la liste des attributs
		$attrs = registry::get($this->get_env(), registry::structure_index, $this->get_table(), 'attr');
		if (empty($attrs))
		{
			trigger_error('Can not find <strong>user</strong> structure', E_USER_ERROR);
		}
		foreach ($attrs as $key => $value)
		{
			$this->set_attr($key, null);
		}
	}

/**
 * Gets the table in the database where the item is stored
 *
 * @return	string	la table de l'objet
 * @access	public
 */
	public function get_table()
	{
		return $this->table;
	}

/**
 * Gets the environement of the item
 *
 * @return	string	admin ou site
 * @access	public
 */
	public function get_env()
	{
		return $this->env;
	}
/**
 * Obtenir la valeur d'un attribut
 *
 * @param	string le nom de l'attribut
 * @access	public
 */
	public function get_nickname()
	{
		return $this->get_table().'_'.$this['id']->get();
	}
/**
 * Obtenir la valeur d'un attribut
 *
 * @param	string le nom de l'attribut
 * @access	public
 */
	public function get_attr($key)
	{
		return $this->data[$key];
	}
/**
 * Modifier la valeur d'un attribut
 *
 * @param	string le nom de l'attribut
 * @access	public
 */
	public function set_attr($key, $value)
	{
		if (isset($this->data[$key]))
		{
			$this->data[$key]->set($value);
		}
		else
		{
			$attrs = registry::get($this->get_env(), registry::structure_index, $this->get_table(), 'attr');
			
			if (isset($attrs[$key]))
			{
				$attrClass = 'attr'.ucfirst($attrs[$key]['type']);
				$this->data[$key] = new $attrClass($value, $attrs[$key]);
			}
			else
			{
				$this->data[$key] = $value;
			}
		}
		return $this;
	}
	
/**
 * Gets the full item from the database, using an id, a key or an array of parameters
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @access	public
 * @final
 */
	public function get($params)
	{
		switch (true)
		{
		//	recherche par id
			case is_numeric($params):
				$param['id'] = $params;
				break;
		//	recherche par string
			case is_string($params):
				$param['key'] = $params;
				break;
			default:
				$param = $params;
				break;
		}
	//	limit
		$param['limit()'] = 1;
	//	query
		$result = database::query_item($this->get_env(), $this->get_table(), $param);
	//	affectation
		if (isset($result[0]))
		{
			$this->set_data($result[0]);
		}
	//	retour
		return $this;
	}
/**
 * Fill the object with all his attributes
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function set_data($data)
	{
		$this->data = $data;
	}
/**
 * Check whether an item exists in base or not
 *
 * @return  bool    true ou false
 * @access  public
 */
	public function exists()
	{
		return ($this->data['id']->exists()) ? true : false;
	}
/**
 * Save item
 *
 * @access  public
 */
	public function save()
	{
	//	conect to db
		$db = database::connect($this->get_env());
	//	update
		if ($this->exists())
		{
			$this->_update();
			$db->flush_spooler();
		}
	//	insert
		else
		{
			$this->insert();
			$this['id']->database_set($db->flush_spooler());
		}
	}
/**
 * Updata item
 *
 * @access  protected
 */
	protected function _update()
	{
	//	conect to db
		$db = database::connect($this->get_env());
	//	préparation des données à mettre à jour
		foreach ($this->data as $attr)
		{
			switch (true)
			{
				case is_a($attr, 'attrId'):
					$id = $attr->get();
					$mainData['id'] = $id;
					break;
				case !is_a($attr, 'attrRel'):
					$mainQuery[] = '`'.$attr->get_key().'`=:'.$attr->get_key();
					$mainData[$attr->get_key()] = $attr->database_get();
					break;
				case is_a($attr, 'attrRel'):
					$rels = $attr->get();
					// print'<pre>';print_r($rels);print'</pre>';
					$i = 0;
					foreach ((array) $rels as $rel)
					{
						$relQuery[] = '(:'.$attr->get_key().'_item_'.$i.',:'.$attr->get_key().'_itemid_'.$i.',:'.$attr->get_key().'_key_'.$i.',:'.$attr->get_key().'_rel_'.$i.',:'.$attr->get_key().'_relid_'.$i.',:'.$attr->get_key().'_position_'.$i.')';
						
						list($table, $id) = explode('_', $rel);
						
						$relData[':'.$attr->get_key().'_item_'.$i] 		= $this->get_table();
						$relData[':'.$attr->get_key().'_itemid_'.$i] 	= $this['id']->get();
						$relData[':'.$attr->get_key().'_key_'.$i] 		= $attr->get_key();
						$relData[':'.$attr->get_key().'_rel_'.$i] 		= $table;
						$relData[':'.$attr->get_key().'_relid_'.$i] 	= $id;
						$relData[':'.$attr->get_key().'_position_'.$i] 	= $i;
						$i++;
					}
					break;
			}
		}
	//	update table entry
		$db->spool('UPDATE `'.$this->get_table().'` SET '.implode(',', $mainQuery).' WHERE `id`=:id', $mainData);
	//	delete previous relations
		$preparedData = array(
			'id' => $id
		);
		$db->spool('DELETE FROM `'.attrRel::table.'` WHERE `item`="'.$this->get_table().'" AND `itemid`=:id', $preparedData);
	//	create relations
		if (isset($relData))
		{
			$db->spool('INSERT INTO `'.attrRel::table.'` (`item`,`itemid`,`key`,`rel`,`relid`,`position`) VALUES '.implode(',', $relQuery), $relData);
		}
	}
/**
 * Insert item
 *
 * @access  protected
 */
	protected function _insert()
	{
	//	conect to db
		$db = database::connect($this->get_env());
	//	préparation des données à mettre à jour
		foreach ($this->data as $attr)
		{
			switch (true)
			{
				case is_a($attr, 'attrId'):
					$id = $attr->get();
					break;
				case !is_a($attr, 'attrRel'):
					$mainQueryCols[] = '`'.$attr->get_key().'`';
					$mainQueryValues[] = ':'.$attr->get_key();
					$mainData[$attr->get_key()] = $attr->database_get();
					break;
				case is_a($attr, 'attrRel'):
					$rels = $attr->get();
					// print'<pre>';print_r($rels);print'</pre>';
					$i = 0;
					foreach ((array) $rels as $rel)
					{
						$relQuery[] = '(:'.$attr->get_key().'_item_'.$i.',:'.$attr->get_key().'_itemid_'.$i.',:'.$attr->get_key().'_key_'.$i.',:'.$attr->get_key().'_rel_'.$i.',:'.$attr->get_key().'_relid_'.$i.',:'.$attr->get_key().'_position_'.$i.')';
						
						list($table, $id) = explode('_', $rel);
						
						$relData[':'.$attr->get_key().'_item_'.$i] 		= $this->get_table();
						$relData[':'.$attr->get_key().'_itemid_'.$i] 	= 'lastid';
						$relData[':'.$attr->get_key().'_key_'.$i] 		= $attr->get_key();
						$relData[':'.$attr->get_key().'_rel_'.$i] 		= $table;
						$relData[':'.$attr->get_key().'_relid_'.$i] 	= $id;
						$relData[':'.$attr->get_key().'_position_'.$i] 	= $i;
						$i++;
					}
					break;
			}
		}
	//	insert table entry
		$db->spool('INSERT INTO `'.$this->get_table().'` ('.implode(',', $mainQueryCols).') VALUES ('.implode(',', $mainQueryValues).')', $mainData, true);
	//	create relations
		if (isset($relData))
		{
			$db->spool('INSERT INTO `'.attrRel::table.'` (`item`,`itemid`,`key`,`rel`,`relid`,`position`) VALUES '.implode(',', $relQuery), $relData);
		}
	}
/**
 * Delete item
 *
 * @access  public
 */
	public function delete()
	{
	//	conect to db
		$db = database::connect($this->get_env());
	//	build the queries
		if ($this->exists())
		{
			$preparedData['id'] = $this['id']->get();
		//	delete main table entry
			$db->spool('DELETE FROM `'.$this->get_table().'` WHERE `id` = :id LIMIT 1', $preparedData);
		//	delete relations
			$db->spool('DELETE FROM `'.attrRel::table.'` WHERE `item` = "'.$this->get_table().'" AND `itemid` = :id', $preparedData);
		}
	//	execute all queries
		$db->flush_spooler();
    }
/********************************************************************************************/
//	ArrayAccess
/********************************************************************************************/
	public function offsetSet($offset, $value)
	{
		$this->set_attr($offset, $value);
	}
	public function offsetExists($offset) 
	{
		return isset($this->data[$offset]);
	}
	public function offsetUnset($offset)
	{
		$this->set_attr($offset, null);
	}
	public function offsetGet($offset)
	{
	//	hack pour corriger le bug php : https://bugs.php.net/bug.php?id=62727
		// return $this->data->data[$offset];
		return (isset($this->data[$offset])) ? $this->data[$offset] : false;
	}
/********************************************************************************************/
//	Iterator
/********************************************************************************************/
	function rewind()
	{
		reset($this->data);
	}
	function current()
	{
		return current($this->data);
	}
	function key() {
		return key($this->data);
	}
	function next()
	{
		next($this->data);
	}
	function valid()
	{
	    return key($this->data) !== null;
	}
}	

?>