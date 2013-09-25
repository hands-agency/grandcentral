<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
abstract class _attrs
{
	protected $data;
	protected $params;

/**
 * Declare attribute
 *
 * @return	string	une string
 * @access	public
 */
	public function __construct($data = null, $params = null)
	{
	//	data
		if (!is_null($data)) $this->set($data);
	//	params
		foreach ((array) $params as $key => $value)
		{
			$method = 'set_'.$key;
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	abstract public function set($data);
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get()
	{
		return $this->data;
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
		$this->set($data);
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
		return $this->get();
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
		return (string) $this->get();
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_key($value)
	{
		$this->params['key'] = $value;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_title($value)
	{
		$this->params['title'] = $value;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_required($value)
	{
		$this->params['required'] = $value;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get_key()
	{
		return $this->params['key'];
	}
}
?>