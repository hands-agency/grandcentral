<?php
/**
 * Array attribute handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrArray extends _attrs implements ArrayAccess, Iterator
{
	protected $data = array();
/**
 * Get the attribute data
 *
 * @param	string	la variable
 * @return	array	data within the attribute
 * @access	public
 */
	public function get()
	{
		return (array) $this->data;
	}
/**
 * Set array attribute
 *
 * @param	mixed	attribute data
 * @access	public
 */
	public function set($data)
	{
		$this->data = (empty($data)) ? array() : (array) $data;
		return $this;
	}
/**
 * Set array attribute for database
 *
 * @param	array	attribute data
 * @access	public
 */
	public function database_set($data)
	{
		$this->data = json_decode($data, true);
		return $this;
	}
/**
 * Get array attribute for database
 *
 * @return	json	a json encoding of the data
 * @access	public
 */
	public function database_get()
	{
		return (!empty($this->data)) ? json_encode($this->data, JSON_UNESCAPED_UNICODE) : '';
	}
/**
 * Display the attribute data inside pre tag.
 *
 * @return	string	the formated data
 * @access	public
 */
	public function __toString()
	{
		return '<pre>'.print_r($this->data, true).'</pre>';
	}
/**
 * Get mysql attribute definition
 *
 * @return	string	a mysql string
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` mediumtext CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
/**
 * Count all elements in an array
 *
 * @return	int		the number of elements into the array
 * @access	public
 */
	public function count()
	{
		return count($this->data);
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
	
/**
 * Default field attributes for Array	
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
		# $params['somefield'] = array();
		unset($params['required']);
	//	Return
		return $params;
	}
}
?>