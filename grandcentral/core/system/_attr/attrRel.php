<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrRel extends _attrs implements ArrayAccess, Iterator
{
	const table = '_rel';
	protected $item;
	protected $data = array();
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get()
	{
		return (array) $this->data;
	}
/**
 * Ajouter une ou plusieurs relations
 *
 * @param	mixed	arrays or bunch of _items or nicknames
 * @access	public
 */
	public function set($rel)
	{
		if (empty($rel))
		{
			$this->data = array();
			return $this;
		}
	//	mise en conformité de l'objet
		if (!is_array($rel) && !is_a($rel, 'bunch')) $rel = array($rel);
	//	on vide
		$this->data = array();
	//	affectation
		foreach ($rel as $value)
		{
			$this->add($value);
		}
		return $this;
	}
/**
 * Add a rel
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function add($rel)
	{
	//	on transforme l'objet en nickname
		if (is_a($rel, '_items'))
		{
			$rel = $rel->get_nickname();
		}
	//	affectation
		$this->data[] = $rel;
		return $this;
	}
/**
 * Delete a rel
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function delete($rel)
	{
	//	Check if the rel exists
		$i = array_search($rel, $this->data);
	//	Delete it
		if ($i !== false)
		{
			unset($this->data[$i]);
			array_keys($this->data);
		}
		return $this;
	}
/**
 * Get complete item url
 *
 * @return	string	url
 * @access	public
 */
	public function attach(_items $item)
	{
		$this->item = $item;
	}
/**
 * Set attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_min($value)
	{
		$this->params['min'] = $value;
		return $this;
	}
/**
 * Set attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_max($value)
	{
		$this->params['max'] = $value;
		return $this;
	}
/**
 * Set attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_param($value)
	{
		$this->params['param'] = $value;
		return $this;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __tostring()
	{
		return '<pre>'.print_r($this->data, true).'</pre>';
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function unfold($params = null)
	{
		$bunch = new bunch(null, null, $this->item->get_env());
		
		$bunch->get_by_nickname($this->data, $params);
		
		return $bunch;
	}
/**
 * Definition mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
		return null;
	}
/**
 * Default field attributes for Rel	
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		$params['rel'] = array(
			'name' => 'param',
			'type' => 'bunch',
			'label' => 'Build your list of items',
		);
		$params['min'] = array(
			'name' => 'min',
			'type' => 'number',
			'label' => 'Min',
		);
		$params['max'] = array(
			'name' => 'max',
			'type' => 'number',
			'label' => 'Max',
		);
	//	Return
		return $params;
	}
/**
 * ArrayAccess Interface methods
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
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
//	Iterator
	function rewind()
	{
		reset($this->data);
	}
	function current()
	{
		return current($this->data);
	}
	function key()
	{
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