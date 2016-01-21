<?php
/**
 * Abstract class for handling attributes
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
abstract class _attrs
{
	protected $data;
	protected $params;

/**
 * Instanciates an new attribute.
 *
 * @param	mixed	attribute data
 * @param	array	attribute parameters
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
 * Set the data into an attribute. Abstract method.
 *
 * @param	mixed	attribute data
 * @access	public
 */
	abstract public function set($data);
/**
 * Get the attribute data
 *
 * @return	mixed	 attribute data value
 * @access	public
 */
	public function get()
	{
		return $this->data;
	}
/**
 * Set the data and post-process it.
 *
 * @param	mixed	attribute data
 * @access	public
 */
	public function database_set($data)
	{
		$this->set($data);
		return $this;
	}
/**
 * Get the raw data for write in bdd
 *
 * @return	mixed	attribute data
 * @access	public
 */
	public function database_get()
	{
		return (empty($this->data)) ? '' : $this->get();
	}
/**
 * Display the attribute
 *
 * @return	string	attribute view
 * @access	public
 */
	public function __tostring()
	{
		return (string) $this->get();
	}
/**
 * Set the attribute key
 *
 * @param	string	key value
 * @access	public
 */
	public function set_key($value)
	{
		$this->params['key'] = (string) $value;
	}
/**
 * Set the attribute title
 *
 * @param	string	title value
 * @access	public
 */
	public function set_title($value)
	{
		$this->params['title'] = (string) $value;
	}
/**
 * Set the attribute required parameter
 *
 * @param	bool	true or false
 * @access	public
 */
	public function set_required($value)
	{
		$this->params['required'] = (bool) $value;
	}
/**
 * Get the attribute name
 *
 * @return	string	attribute key
 * @access	public
 */
	public function get_key()
	{
		return $this->params['key'];
	}
/**
 * Check if the attribute data is empty
 *
 * @return	bool	true if is empty, false otherwise
 * @access	public
 */
	public function is_empty()
	{
		return (empty($this->data)) ? true : false;
	}
/**
 * Get mysql attribute definition
 *
 * @return	string	a mysql string
 * @access	public
 */
	abstract public function mysql_definition();
/**
 * Get mysql index definition
 *
 * @return	string	a mysql string
 * @access	public
 */
	public function mysql_index_definition()
	{
		return null;
	}
/**
 * Return the attr data json
 * @access	public
 */
	public function json()
	{
		return json_encode($this->data);
	}
/**
 * Get the properties of an attributes
 *
 * @return	array	an array of attribute properties
 * @access	public
 */
	public static function get_properties()
	{
		$params = array();
		$params['key'] = array(
			'name' => 'key',
			'type' => 'text',
			'label' => 'Key',
			'max' => 32,
			'required' => true,
			'customdata' => array('associative' => 'attr')
		);
		$params['type'] = array(
			'name' => 'type',
			'type' => 'text',
			'required' => true,
			'readonly' => true,
			'value' => mb_substr(mb_strtolower(get_called_class()), 4),
		);
		// $params['title'] = array(
		// 	'name' => 'title',
		// 	'type' => 'text',
		// 	'label' => 'Title',
		// 	'max' => 255,
		// 	'required' => true
		// );
		$params['required'] = array(
			'name' => 'required',
			'type' => 'bool',
			'label' => 'Required',
			'labelbefore' => true
		);

		$available = registry::get_class('field');
		//	Get the properties for each attr
		foreach ($available as $field) $fields[$field] = mb_substr(mb_strtolower($field), 5);
		//	Somes specifics for this attr
		$params['adminField'] = array(
			'placeholder' => '...',
			'name' => 'field',
			'type' => 'select',
			'label' => 'Default field',
			'values' => $fields,
			'valuestype' => 'array'
		);
	//	Return
		return $params;
	}
}
?>
