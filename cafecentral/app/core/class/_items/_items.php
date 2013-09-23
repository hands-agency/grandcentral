<?php
/**
 * La classe abstraite de manipulation des objets Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @see      http://www.cafecentral.fr/fr/wiki
 * @abstract
 */
abstract class _items implements ArrayAccess, Iterator
{
	public $data;
	public $rel;
	
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  admin ou site (environnement courant par défaut)
 * @access	public
 */
	public function __construct($param = null, $env = env)
	{
		$table = get_called_class();
		if (!in_array($env, array('admin', 'site')))
		{
			trigger_error('Environment should be admin or site, not '.$env);
			$env = env;
		}
		$this->data = new data($table, $env);
		if ($param != null) $this->get($param);
	}

/**
 * Gets the table in the database where the item is stored
 *
 * @return	string	la table de l'objet
 * @access	public
 */
	public function get_table()
	{
		return $this->data->get_table();
	}

/**
 * Gets the environement of the item
 *
 * @return	string	admin ou site
 * @access	public
 */
	public function get_env()
	{
		return $this->data->get_env();
	}
/**
 * Retourne le nom court de l'objet 
 *
 * Le nom cout d'un objet est composé de sa table et de son id
 * ex : page_1, app_3
 *
 * @return	string	le nom court de l'objet
 * @access	public
 */
	public function get_nickname()
	{
		return $this->get_table().'_'.$this['id'];
	}
	
/**
 * Retourne la référence d'un objet
 *
 * Le nom cout d'un objet est composé de sa table et de son id
 * ex : page_1, app_3
 *
 * @return	string	le nom court de l'objet
 * @access	public
 */
	public function get_ref()
	{
		return $this->get_table().' #'.$this['id'];
	}
	
/**
 * Obtenir la valeur d'un attribut
 *
 * @param	string le nom de l'attribut
 * @access	public
 */
	public function get_attr($attr)
	{
		return $this[$attr];
	}
/**
 * Modifier la valeur d'un attribut
 *
 * @param	string le nom de l'attribut
 * @access	public
 */
	public function set_attr($attr, $val)
	{
		$this[$attr] = $val;
		return $this;
	}
/**
 * Gets the full item from the database, using an id, a key or an array of parameters
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @access	public
 * @final
 */
	final public function get($param)
	{
	//	récupération de la structure de l'objet demandé
		$s = $this->get_structure();
	//	analyse des paramètres reçus
		$attr = array();
		$rel = array();
		switch ($param)
		{
		//	is_array
			case is_array($param):
				foreach ((array) $param as $key => $value)
				{
					if ($s->attr_exists($key) || in_array($key, array('order()', 'limit()')))
					{
						$attr[$key] = $value;
					}
					elseif ($s->rel_exists($key))
					{
						$rel[$key] = $value;
					}
				}
				break;
		//	recherche par id
			case is_numeric($param):
				$attr['id'] = $param;
				break;
		//	recherche par string
			default:
				$attr['key'] = $param;
				break;
		}
	//	version
		if ($this->is_versionable() && !isset($rel['version']))
		{
			// print '<pre>sdfdf';print_r(registry::get(registry::current_index, $this->get_env(), 'version', 'id'));print'</pre>';
			$v = registry::get(registry::current_index, $this->get_env(), 'version');
			$rel['version'] = $v['id'];
		}
	//	limit
		$attr['limit()'] = 1;
	//	requête des datas
		$db = database::connect($this->get_env());
		$data = $db->querydata($this->get_table(), $attr, $rel);
		if (isset($data[0]))
		{
			$this->set_data($data[0]);
		//	requête des relations
			if ($s->has_rel())
			{
				$attr = array(
					'item' => $this->get_table(),
					'itemid' => $this['id'],
					'order()' => 'key, position'
				);
				$rels = $db->querydata(dataRel::table, $attr);
		
				foreach ($rels as $rel)
				{
					$this->rel[$rel->data['key']][$rel->data['rel'].'_'.$rel->data['relid']] = $rel;
				}
			}
		}
		
	//	retour
		return $this;
	}
/**
 * Link the item with a data item
 *
 * @param	_datas	a data item
 * @access	public
 */
	public function set_data(_datas $data)
	{
		$this->data = $data;
		return $this;
	}
/**
 * Gets the relations of an item and returns them in a bunch of items
 *
 * @param	string  la clé de la relation
 * @param	array 	les paramètres additionnels (même paramètres possible que pour un bunch excepté les ids)
 * @return	bunch	le bunch d'objets avec les paramètres demandés
 * @access	public
 */
	public function get_rel($key, $param = null)
	{
		$b = new bunch(null, null, $this->get_env());
		$s = item::create('structure', $this->get_table(), $this->get_env());
		if ($s->rel_exists($key) && !empty($this->rel[$key]))
		{
			foreach ($this->rel[$key] as $rel)
			{
				$ids[$rel->data['rel']][] = $rel->data['relid'];
			}
			// print '<pre>';print_r($ids);print'</pre>';
			
			foreach ($ids as $table => $values)
			{
				$param['id'] = $values;
				$param['order()'] = 'inherit(id)';
				$b->get($table, $param);
			}
		}
		return $b;
	}
/**
 * Replaces the existing relations by new ones
 *
 * @param	string  la clé de la relation
 * @param	mixed	une id simple ou un tableau d'id
 * @access	public
 */
	public function set_rel($key, $ids)
	{
	//	on vérifie que la relation est permise
		$s = $this->get_structure();
		if ($s->rel_exists($key))
		{
			if (is_object($ids) && (get_class($ids) == 'bunch' || is_subclass_of($ids, '_items')))
			{
				$ids = $ids->get_nickname();
			}
			$rels = array();
			$pos = 1;
		//	pour toutes les ids reçues
			foreach ((array) $ids as $id)
			{
				if ($rel = $this->_prepare_rel($key, $id, $pos))
				{
					$rels[$rel->data['rel'].'_'.$rel->data['relid']] = $rel;
					$pos++;
				}
			}
		//	on remplace les relations existantes
			$this->rel[$key] = $rels;
		}
		return $this;
	}
	
/**
 * Adds a relation to the existing ones
 *
 * @param	string  la clé de la relation
 * @param	mixed	une id simple ou un tableau d'id
 * @access	public
 */
	public function add_rel($key, $ids)
	{
	//	on vérifie que la relation est permise
		$s = $this->get_structure();
		if ($s->rel_exists($key))
		{
			if (is_object($ids) && (get_class($ids) == 'bunch' || is_subclass_of($ids, '_items')))
			{
				$ids = $ids->get_nickname();
			}
			$pos = (isset($this->rel[$key])) ? count($this->rel[$key]) + 1 : 1;
		//	pour toutes les ids reçues
			foreach ((array) $ids as $id)
			{
				if ($rel = $this->_prepare_rel($key, $id, $pos))
				{
					if (!isset($this->rel[$key][$rel->data['rel'].'_'.$rel->data['relid']]))
					{
						$this->rel[$key][$rel->data['rel'].'_'.$rel->data['relid']] = $rel;
					}
					$pos++;
				}
			}
		}
		return $this;
	}
	
/**
 * Deletes a relation from an item
 *
 * @param	string  the nickname of the section
 * @access	public
 */
	public function delete_rel($nickname)
	{
	//	Only if rel isset, unset
		list($item, $id) = explode('_', $nickname);
		if (isset($this->rel[$item][$nickname])) unset($this->rel[$item][$nickname]);
		return $this;
	}

/**
 * Prepare a relation
 *
 * @param	string  la clé de la relation
 * @param	mixed	une id simple (ex : 1 ou version_1)
 * @param	int		la position de la relation
 * @return	mixed	false en cas d'échec sinon un objet dataRel
 * @access	private
 */
	private function _prepare_rel($key, $id, $pos)
	{
		if (empty($id)) return false;
		$s = $this->get_structure();
		// $tables = (array) $s->data->data['rel'][$key]['item'];
		

		// print '<fieldset class="debug" style="position: absolute;top:0;left:0;background:#FFF;"><legend>'.__FUNCTION__.'() in '.__FILE__.' line '.__LINE__.'</legend><pre>';print_r($s->data->data['rel'][$key]['item']);print'</pre></fieldset>';
		
		// foreach ((array) $s->data->data['rel'][$key]['item'] as $value)
		// 		{
		// 			if (!is_array($value)) $value = array('table' => $value);
		// 			$tables[] = $value['table'];
		// 		}

		foreach ((array) $s->data->data['rel'][$key]['item'] as $value)
		{
			if (!is_array($value)) $value = array('item' => $value);
			$tables[] = $value['item'];
		}

	//	on formate l'id
		if (strstr($id, '_'))
		{
			list($table, $id) = explode('_', $id);
			// print '<pre>';print_r($tables);print'</pre>';
		//	si la table passée ne correspond pas, on élude
			if(false) // if (!in_array($table, $tables))
			{
				// print '<pre>';print_r('ixi');print'</pre>';
				return false;
			}
		}
		else
		{
			$table = $tables[0];
		}
	//	si la relation est déjà présente, on élude
		// if (isset($this->rel[$key][$table.'_'.$id]))
		// {
		// 		print '<pre>';print_r($table);print'</pre>';
		// 	return false;
		// }
	//	on crée la relation
		$rel = new dataRel($this->get_env());
		$rel->data = array(
			'item' => $this->get_table(),
			'itemid' => $this['id'],
			'key' => $key,
			'rel' => $table,
			'relid' => $id,
			'position' => $pos
		);
		return $rel;
	}
/**
 * Gets reverse relations
 *
 * @param	string  la table des objets recherchés
 * @return	bunch	le bunch des résultats
 * @access	public
 */
	public function get_irel($table)
	{
		$p = array(
			'rel' => $this->get_table(),
			'relid' => $this['id'],
			'item' => $table
		);
		$q = 'SELECT `itemid` FROM `_rel` WHERE `rel` = :rel AND `relid` = :relid AND `item` = :item ORDER BY `position`';
		$db = database::connect($this->env);
		$r = $db->query($q, $p);
		
		$irels = null;
		if ($r['count'] > 0)
		{
			foreach ($r['data'] as $value)
			{
				$ids[] = $value['itemid'];
			}
			
			$param = array(
				'id' => $ids,
				'order()' => 'inherit(id)'
			);
			$irels = new bunch($table, $param, $this->get_env());
		}
		return $irels;
	}

/**
 * Gets the structure of the item
 *
 * @return	structure	la structure de l'objet en cours
 * @access	public
 */
	public function get_structure()
	{
		$s = item::create('structure', $this->get_table(), $this->get_env());
		return $s;
	}
/**
 * Tells whether the item is versionable
 *
 * @return	bool	true si l'objet supporte les versions, false sinon
 * @access	public
 */
	public function is_versionable()
	{
		return $this->get_structure()->is_versionable();
	}
/**
 * Check if the key is declared as relation
 *
 * @param	string  the relation's key
 * @return	bool	true ou false
 * @access	public
 */
	public function rel_exists($value)
	{
		return $this->get_structure()->rel_exists($value);
	}
/**
 * Check whether an item exists in base or not
 *
 * @return  bool    true ou false
 * @access  public
 */
    public function exists()
    {
        return (isset($this['id'])) ? true : false;
    }	
/**
 * Returns the front-end URL of an item
 *
 * @param	array	An associative array of arguments added to the URL
 * @return	string	The URL of the object
 * @access	public
 */
	public function link($arg = null)
	{
	//	Return
		if (isset($this['url']))
		{
		//	Args?
			if (isset($arg)) $arg = '?'.http_build_query($arg);
		//	Return
			return constant(mb_strtoupper($this->get_env()).'_URL').$this['url'].$arg;
		}
		else return false;
	}
	
/**
 * Returns the link to the back-end listing of these items
 *
 * @return	string	l'url de l'objet
 * @access	public
 */
	public function listing()
	{
		return '/admin/list?item='.$this->get_table();
	}
	
/**
 * Returns the link to the back-end form of a particular item
 *
 * @return	string	l'url de l'objet
 * @access	public
 */
	final public function edit()
	{
		return '/admin/edit?item='.$this->get_table().'&id='.$this['id'];
	}

/**
 * Returns the link to the back-end form of a particular item
 *
 * @return	string	l'url de l'objet
 * @access	public
 */
	public function prepare_save()
	{
		$this->set_data($this->data);
		return $this;
	}
/**
 * Saves an item in the database
 *
 * @access	public
 */
	final public function save()
	{
	//	préchargement automatique de la version
		if ($this->is_versionable() && !isset($this->rel['version']))
		{
			$this->set_rel('version', registry::get(current, 'version')->get_attr('id'));
		}
	//	remplissage auto de l'auteur de l'article
		if ($this->get_env() == 'site')
		{
			$this->add_rel('author', $_SESSION['user']->get_nickname());
		}
	//	preparation de la sauvegarde
		$this->prepare_save();
	//	sauvegarde des attributs
		$this->data->prepare_save();
	//	éxécution des requêtes
		$this->data->execute();
		
	//	Return the id
		if (empty($this['id']))
		{
			$this['id'] = $this->data->get_last_inserted_id();
			$event = 'insert';
		}
		else $event = 'update';
		
	//	sauvegarde des relations
		if ($this->get_structure()->has_rel())
		{
			foreach ((array) $this->rel as $rels)
			{
				foreach ($rels as $rel)
				{
					$rel->data['itemid'] = $this['id'];
					$rel->prepare_delete();
					$rel->prepare_save();
				}
			}
		}
		$this->data->execute();
		// $this->data->execute();
		// if ($this->get_structure()->has_rel())
		// 		{
		// 		//	on efface les relations
		// 			$this->_delete_rel();
		// 		//	on sauvegarde toutes les relations en une fois
		// 			$r = new dataRel(null, $this->get_env());
		// 			$q = $r->prepare_insert();
		// 			$i = 0;
		// 			$d = array();
		// 			foreach ((array) $this->rel as $rels)
		// 			{
		// 				foreach ($rels as $rel)
		// 				{
		// 					$rel->data['item'] = $this->get_table();
		// 					$rel->data['itemid'] = $this['id'];
		// 					$values = $rel->prepare_values($i);
		// 					$prepare[] = $values['values'];
		// 					$d = array_merge($d, $values['data']);
		// 					$i++;
		// 				}
		// 			}
		// 			$q = $q.implode(',', $prepare);
		// 			$db = database::connect($this->get_env());
		// 			$db->query($q, $d);
		// 		}
	//	Trigger event
		event::trigger($this, $event);
	//	Return
		return $this;
	}

/**
 * Duplicates an item in the database
 *
 * @access	public
 */
	public function copy()
	{
	//	Delete id
		unset($this['id']);
	//	re-create
		$this->save();
		
	//	Trigger event & return
		event::trigger($this, __FUNCTION__);
		return $this;
	}

/**
 * Deletes an item
 *
 * @access	public
 */
	public function delete()
	{
	// //	clean relations
	// 	$this->_delete_rel();
	// //	clean relations
	// 	$this->data->delete();
	
	//	sauvegarde des attributs
		$this->data->prepare_delete();
	//	sauvegarde des relations
		if ($this->get_structure()->has_rel())
		{
			foreach ((array) $this->rel as $rels)
			{
				foreach ($rels as $rel)
				{
					$rel->prepare_delete();
				}
			}
		}
	//	éxécution des requêtes
		$this->data->execute();
		
	//	Trigger event & return
		event::trigger($this, __FUNCTION__);
		return $this;
	}

/********************************************************************************************/
//	ArrayAccess
/********************************************************************************************/
	public function offsetSet($offset, $value)
	{
		$this->data->data[$offset] = $value;
	}
	public function offsetExists($offset) 
	{
		return isset($this->data->data[$offset]);
	}
	public function offsetUnset($offset)
	{
		unset($this->data->data[$offset]);
	}
	public function offsetGet($offset)
	{
	//	hack pour corriger le bug php : https://bugs.php.net/bug.php?id=62727
		// return $this->data->data[$offset];
		return (isset($this->data->data[$offset])) ? $this->data->data[$offset] : false;
	}
//	Iterator
	function rewind()
	{
		reset($this->data->data);
	}
	function current()
	{
		return current($this->data->data);
	}
	function key() {
		return key($this->data->data);
	}
	function next()
	{
		next($this->data->data);
	}
	function valid()
	{
	    return key($this->data->data) !== null;
	}
}
?>