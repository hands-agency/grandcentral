<?php
/**
 * Decimal formatted attribute handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrDecimal extends _attrs
{
	protected $params = array(
		'decimal' => 2,
		'function' => 'round'
	);
/**
 * Set the data into attribute
 *
 * @param	string	numeric attribute data
 * @access	public
 */
	public function set($data)
	{
		$this->data = (is_numeric($data)) ? $data : 0;
		return $this;
	}
/**
 * Get the attribute data
 *
 * @return	string	 attribute data value
 * @access	public
 */
	public function get()
	{
		return $this->params['function']($this->data, $this->params['decimal']);
	}
/**
 * Get mysql attribute definition
 *
 * @return	string	a mysql string
 * @access	public
 */
	public function mysql_definition()
	{
		if (empty($this->params['max'])) $this->params['max'] = 10000000;
		if (empty($this->params['round'])) $this->params['round'] = 2;
		
	//	definition
		$definition = '`'.$this->params['key'].'` decimal('.strlen($this->params['max']).','.$this->params['round'].') NOT NULL';
	//	retour
		return $definition;
	}
	
/**
 * Get the properties of an attributes
 *
 * @return	array	an array of attribute properties
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		$params['round'] = array(
			'name' => 'round',
			'type' => 'number',
			'label' => 'Round'
		);
	//	Return
		return $params;
	}
}
?>