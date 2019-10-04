<?php
/**
 * Handles bunches of items
 *
 * This class will let you search, order, save, delete bunches in the database. For instance all the socks at once:
 * <pre>
 * // Fetch all the socks
 * $bunch = new bunch('socks', all);
 * </pre>
 * Bunches parameters let you refine your selection with various values:
 * <pre>
 * // Fetch a bunch of socks
 * $p = array(
 * 	'title' => 'best-offer%',
 * 	'size' => array('XL', 'L'),
 * 	'codes' => array(2, 4),
 * 	'tag' => 1,
 * 	'order()' => 'color DESC, size ASC',
 * 	'limit()' => 10,
 *  'instock' => true,
 * );
 * $bunch = new bunch('socks', $p);
 * </pre>
 * By calling several times the get() method, you'll be able to handle different types of items at the same time, like pairs of blue socks and XL jumpers:
 * <pre>
 * // Fetch socks and jumpers in one bunch
 * $bunch = new bunch();
 * $bunch-get('socks',
 * 	 array(
 *   'color' => 'blue',
 *  )
 * );
 * $bunch-get('jumpers',
 * 	array(
 *   'size' => 'XL',
 *  )
 * );
 * </pre>
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class bunch implements ArrayAccess, Iterator, Countable
{
	private $env;
	private $_cIndex = false;
	private $_sIndex;
	public $count = 0;
	public $data = array();

/**
 * Instantiate a bunch of items
 *
 * @param	string  The key of the items we want to handle (ie: "page", "human", "version"...). Leave null for an empty bunch
 * @param	array  	The list of filtering parameters
 * @param	string  The environment we want to work on: "site" or "admin"
 * @access	public
 */
	public function __construct($table = null, $params = null, $env = env)
	{
		if (!in_array($env, array('admin', 'site')))
		{
			trigger_error('Environment should be admin or site, not <strong>'.$env.'</strong>', E_USER_ERROR);
			$env = env;
		}
		$this->env = $env;
		if ($table !== null) $this->get($table, $params);
	}

/**
 * Return the environment of a bunch
 *
 * @return	string	The environment of a bunch ("site" or "admin")
 * @access	public
 */
	public function get_env()
	{
		return $this->env;
	}

/**
 * Deduplicate a bunch
 *
 * @return	string	The deduplicated bunch
 * @access	public
 */
	public function deduplicate()
	{
	//	Some vars
		$i = 0;
		$tmp = array();
		$done = array();

	//	Lets' get to work
		while ($i < $this->count)
		{
			if (!in_array($this->data[$i]->get_nickname(), $done))
			{
				$tmp[] = $this->data[$i];
				$done[] = $this->data[$i]->get_nickname();
			}
			$i++;
		}
		$this->data = $tmp;
		$this->count();
	}
/**
 * Order a bunch of items
 *
 * @param	string	The order key (ie: "title", "id", "created")
 * @param	bool	Reverse order ("false" by default)
 * @return	string	The ordered bunch
 * @access	public
 */
	public function order($index, $reverse = false)
	{
	//	on extrait la colonne à trier
		$extract = $this->get_column($index);
		//uasort($extract, 'strcoll');
		if (empty($extract)) return $this;
		//sort($extract, SORT_LOCALE_STRING);
		natcasesort($extract);
	//	on récupère les index triés
		$sorted = array_keys($extract);
		if ($reverse === true) $sorted = array_reverse($sorted);
	//	on réordonne le tableau
		$i = 0;
		// $this->set_index();
		$this->count();
		while ($i < $this->count)
		{
			$tmp[$i] = $this->data[$sorted[$i]];
			$i++;
		}
		$this->data = &$tmp;
		$this->order = $index;

		array_values($this->data);

		return $this;
	}

/**
 * Use the key of an attribute instead of a numeric index
 *
 * @param	string	The desired index (ie: "id", "key"...)
 * @return	string	The indexed bunch
 * @access	public
 */
	public function set_index($index = false)
	{
		$this->_sIndex = $this->_cIndex;
		if ($index === false)
		{
			$this->data = array_values($this->data);
		}
		else
		{
			$datas = array();
			foreach ($this->data as $data)
			{
				if (is_object($data)) $datas[$data->get_table().'_'.$data[$index]] = $data;
			}
			$this->data = $datas;
		}
		$this->_cIndex = $index;

		return $this;
	}

/**
 * Revert the bunch index to its previous key
 *
 * @access	public
 * @return	string	The bunch indexed with its previous index key
 */
	public function restore_index()
	{
		$index = $this->_sIndex;
		$this->set_index($index);
		$this->_sIndex = $index;

		return $this;
	}

/**
 * Extract all values of a given attribute
 *
 * @param	string  The attribute (ie: "id", "title"...)
 * @return	array	All values of the given attributes figuring in the bunch
 * @access	public
 */
	public function get_column($column, $assoc = true)
	{
		$columns = array();
		foreach ($this->data as $item)
		{
			if (!is_a($item, '_items') || !isset($item[$column]))
			{
				$c = '';
				$assoc = true;
			}
			else
			{
				$c = is_a($item[$column], '_attrs') ? $item[$column]->get() : '';
			}

			if ($assoc === true)
			{
				$columns[] = $c;
			}
			else
			{
				$columns[$item->get_nickname()] = $c;
			}
		}
	//	retour
		return $columns;
	}

/**
 * Get an array of nicknames of all the items in the bunch
 *
 * @return	array	The List of nicknames of the items in the bunch
 * @access	public
 */
	public function get_nickname()
	{
		$tags = array();
		foreach ($this->data as $data)
		{
			$tags[] = $data->get_nickname();
		}
	//	retour
		return $tags;
	}

/**
 * Get all the given attributes
 *
 * @return	string	The key of the attribute
 * @access	public
 */
	public function get_attr($key)
	{
		foreach ($this->data as $data)
		{
			$attrs[] = $data->get_attr($key);
		}
	//	retour
		return $attrs;
	}

/**
 * Fetch additional items for a bunch
 *
 * <pre>
 * // A list of filtering parameters
 * $param = array(
 * 	'key' => 'home%',
 * 	'type' => array('html', 'ajax'),
 * 	'section' => array(2, 4),
 * 	'tag' => 1,
 * 	'order()' => 'key DESC, type ASC',
 * 	'limit()' => 10
 * );
 * // Fetch!
 * $bunch->get('page', $param);
 * </pre>
 *
 * @param	string  item's name
 * @param	array  	parameters
 * @access	public
 */
	public function get($table, $params = null)
	{
	//	query
		$results = database::query_item($this->get_env(), $table, $params);
	//	création des objets et affectation des valeurs
		foreach ($results as $result)
		{
			$item = item::create($table, null, $this->get_env());
			$item->database_set($result);
			$this->data[] = $item;
		}
	//	count
		$this->count();
	//	pour être sur de travailler dans le même environnement que l'objet cherché
		if (isset($item))
		{
			$this->env = $item->get_env();
		}
	//	return himself
		return $this;
	}
/**
 * Search items by nickname
 *
 * Example:
 * <pre>
 * $bunch->get(array(
 * 	page_1, page_2, page_3
 * ), array(
 * 	'order()' => 'created desc'
 * ));
 * </pre>
 * @param	array	array of nicknames
 * @param	array	array of parameters
 * @access	public
 */
	public function get_by_nickname($nicknames, $params = null)
	{
		// print'<pre>';print_r($nicknames);print'</pre>';
		$nicknames = array_filter((array) $nicknames);
	//	analyse des nicknames
		foreach ($nicknames as $nickname)
		{
			list($table, $id) = explode('_', $nickname);
			$ids[$table][] = $id;
		}
	//	Only if we have params
		if (!empty($ids))
		{
		//	recherche des items
			foreach ($ids as $table => $id)
			{
				$params['id'] = $id;
				if (!isset($params['order()']))
				{
					$params['order()'] = 'inherit(id)';
				}
				$this->get($table, $params);
			}
			//	tri
			if (count($ids) > 1)
			{
				foreach ($this->data as $item)
				{
					$order[] = array_search($item->get_nickname(), $nicknames);
				}
				asort($order);
				foreach ($order as $key => $index)
				{
					$data[$index] = $this->data[$key];
				}
				$this->data = array_values($data);
			}
		}
		return $this;
	}

/**
 * Refine a bunch by searching in its content
 *
 * @param	string	the query string
 * @access	public
 */
	public function refine($string)
	{
	//	For each item in the bunch
		$items = $this->data;
		foreach ($items as $item)
		{
		//	For each field
			$field = $item->data->data;
			foreach($field as $key => $value)
			{
				if (!empty($value) && mb_stristr($value, $string))
				{
					$return_items[] = $item;
					break;
				}
			}
		}
	//	Return our bunch or an empty bunch
		$return = new bunch();
		if (isset($return_items)) $return->set($return_items);
		return $return;
	}

/**
 * Save all the items of the bunch in the database
 *
 * @access	public
 */
	// public function save()
	// {
	// 	foreach ($this->data as $item)
	// 	{
	// 	//	préchargement automatique de la version
	// 		if ($item->is_versionable() && !isset($item->rel['version']))
	// 		{
	// 	        $item->set_rel('version', registry::get(current, 'version')->get_attr('id'));
	// 		}
	//
	// 		$item->prepare_save();
	// 	//	sauvegarde des attributs
	// 		$item->data->prepare_save();
	// 	//	sauvegarde des relations
	// 		if ($item->get_structure()->has_rel())
	// 		{
	// 			foreach ((array) $item->rel as $rels)
	// 			{
	// 				foreach ($rels as $rel)
	// 				{
	// 					// $rel->prepare_delete();
	// 					$rel->prepare_save();
	// 				}
	// 			}
	// 		}
	// 	}
	//
	// //	éxécution des requêtes
	// 	reset($this->data);
	// 	current($this->data)->data->execute();
	//
	//
	// 	$lastid = $item->data->get_last_inserted_id();
	// 	return $this;
	// }

/**
 * Delete from database all the items of the bunch
 *
 * @access	public
 */
	// public function delete()
	// {
	// 	foreach ($this->data as $item) $item->delete();
	// 	return $this;
	// }

/**
 * Serialize this bunch in Json
 *
 * @param	array  Filter lets you choose a set of fields to be retrieved
 * @access	public
 */
	public function json($filter = null)
	{
		$return = array();
		foreach ($this->data as $item) if ($item->json($filter)) $return[] = $item->json($filter);
        return '['.implode(',',$return) .']';
    }

/**
 * Arrayaccess
 * http://php.net/manual/en/class.arrayaccess.php
 *
 */
	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) $this->data[] = $value;
		else $this->data[$offset] = $value;
	}
	public function offsetExists($offset)
	{
		return isset($this->data[$offset]);
	}
	public function offsetUnset($offset)
	{
		unset($this->data[$offset]);
	}
	public function offsetGet($offset)
	{
		return isset($this->data[$offset]) ? $this->data[$offset] : null;
	}
/**
 * Interface Iterator
 * http://php.net/manual/en/class.iterator.php
 *
 */
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
/**
 * Interface Countable
 * http://php.net/manual/en/class.countable.php
 *
 */
	public function count()
    {
		$this->count = count($this->data);
        return $this->count;
    }
}
?>
