<?php
/**
 * Handles bunches of items
 *
 * This class will let you search, order, save, delete bunches in the database
 * By stacking up get(), you'll be able to handle different types of items
 * at the same time, like pairs of socks, jumpers and t-shirts.
 *
 * Example:
 * $param = array(
 * 	'key' => 'home%',
 * 	'type' => array('html', 'ajax'),
 * 	'section' => array(2, 4),
 * 	'tag' => 1,
 * 	'order()' => 'key DESC, type ASC',
 * 	'limit()' => 10 
 * );
 * $bunch = new bunch('page', $param, 'admin');
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class bunch implements ArrayAccess, Iterator, Countable, JsonSerializable
{	
	private $_env;
	private $_cIndex = false;
	private $_sIndex;
	public $count = 0;
	public $data = array();

/**
 * Instantiate a bunch of items
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function __construct($table = null, $params = null, $env = env)
	{
		if (!in_array($env, array('admin', 'site')))
		{
			trigger_error('Environment should be admin or site, not '.$env);
			$env = env;
		}
		$this->_env = $env;
		if ($table !== null) $this->get($table, $params);
	}

/**
 * Returns the environnement of the bunch
 *
 * @return	string	l'environnement actif : admin ou site
 * @access	public
 */
	public function get_env()
	{
		return $this->_env;
	}

/**
 * Order the bunch of items
 *
 * @param	string	l'index du tri
 * @param	bool	inverse l'ordre du tri (false par défaut)
 * @access	public
 */	
	public function order($index, $reverse = false)
	{
	//	on extrait la colonne à trier
		$extract = $this->get_column($index);
		//uasort($extract, 'strcoll');
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
 * Alter the index of the bunch
 *
 * @param	string	le nouvel index désiré
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
 * Restore the index of the bunch to previous
 *
 * @access	public
 */
	public function restore_index()
	{
		$index = $this->_sIndex;
		$this->set_index($index);
		$this->_sIndex = $index;
		
		return $this;
	}

/**
 * Extraire le champ demandé de tous les éléments de la liste
 *
 * @param	string  l'index du champ à extraire
 * @return	array	le tableau des valeurs du champ demandé
 * @access	public
 */
	public function get_column($index, $table = null)
	{
		foreach ($this->data as $data)
		{
			if (is_object($data)) $column[$data->get_table()][] = $data[$index];
			else $column[] = $data[$index];
		}
		if (!empty($table))
		{
			$column = $column[$table];
		}
	//	retour
		return $column;
	}
	
/**
 * Retourne les noms courts des objets 
 *
 * Le nom cout d'un objet est composé de sa table et de son id
 * ex : page_1, app_3
 *
 * @return	array	le tableau des noms courts
 * @access	public
 */
	public function get_nickname()
	{
		foreach ($this->data as $data)
		{
			$tags[] = $data->get_nickname();
		}
	//	retour
		return $tags;
	}
	
/**
 * Retourne les valeurs de l'attribut passé en paramètre
 *
 * @return	string	la clé de l'attribut
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
 * Get data from database using parameters
 * 
 * Example:
 * $param = array(
 * 	'key' => 'home%',
 * 	'type' => array('html', 'ajax'),
 * 	'section' => array(2, 4),
 * 	'tag' => 1,
 * 	'order()' => 'key DESC, type ASC',
 * 	'limit()' => 10 
 * );
 * $bunch->get('page', $param);
 *
 * @param	string  le type d'objet recherché
 * @param	array  	Le tableau de paramètres
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
			$item->set_data($result);
			$this->data[] = $item;
		}
		
	//	count
		$this->count();
		
		return $this;
	}
/**
 * Search by nickname
 *
 * @param	array	array of _items nicknames
 * @access	public
 */
	public function get_by_nickname($nicknames)
	{
		// print'<pre>';print_r($nicknames);print'</pre>';
		$nicknames = (array) $nicknames;
	//	analyse des nicknames
		foreach ($nicknames as $nickname)
		{
			list($table, $id) = explode('_', $nickname);
			$params[$table][] = $id;
		}
	//	Only if we have params
		if (!empty($params))
		{
		//	recherche des items
			foreach ($params as $table => $ids)
			{
				$this->get($table, array('id' => $ids));
			}
		//	tri
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
		return $this;
	}

/**
 * Refine a bunch by searching in its content
 *
 * @param	string	La chaîne à rechercher
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
	public function save()
	{
		foreach ($this->data as $item)
		{
		//	préchargement automatique de la version
			if ($item->is_versionable() && !isset($item->rel['version']))
			{
		        $item->set_rel('version', registry::get(current, 'version')->get_attr('id'));
			}
			
			$item->prepare_save();
		//	sauvegarde des attributs
			$item->data->prepare_save();
		//	sauvegarde des relations
			if ($item->get_structure()->has_rel())
			{
				foreach ((array) $item->rel as $rels)
				{
					foreach ($rels as $rel)
					{
						// $rel->prepare_delete();
						$rel->prepare_save();
					}
				}
			}
		}
		
	//	éxécution des requêtes
		reset($this->data);
		current($this->data)->data->execute();
		
		
		$lastid = $item->data->get_last_inserted_id();
		return $this;
	}

/**
 * Delete from database all the items of the bunch
 *
 * @access	public
 */
	public function delete()
	{
		foreach ($this->data as $item) $item->delete();
		return $this;
	}

/**
 * Serialize this bunch in Json
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function jsonSerialize()
	{
		/* TODO */
        return 'todo';
    }

//	Arrayaccess
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
//	Iterator
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
//	Countable
	public function count()
    {
		$this->count = count($this->data);
        return $this->count;
    }
}
?>