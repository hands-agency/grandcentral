<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrArray extends _attrs implements ArrayAccess, Iterator
{
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (array) $data;
		return $this;
	}
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_set($data)
	{
		$this->data = json_decode($data, true);
		return $this;
	}
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_get()
	{
		return json_encode($this->data, JSON_UNESCAPED_UNICODE);
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __toString()
	{
		return '<pre>'.print_r($this->data, true).'</pre>';
	}
/**
 * Definition mysql
 * ex : `param` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public static function mysql_definition($attr)
	{
	//	definition
		$definition = '`'.$attr['key'].'` mediumtext CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
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