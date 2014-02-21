<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrDecimal extends _attrs
{
	protected $params = array(
		'decimal' => 2,
		'function' => 'round'
	);
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (is_numeric($data)) ? $data : 0;
		return $this;
	}
/**
 * Get string attribute
 *
 * @return	string	une string
 * @access	public
 */
	public function get()
	{
		return $this->params['function']($this->data, $this->params['decimal']);
	}
/**
 * Definition mysql
 * ex : `salary` decimal(10,2) NOT NULL
 *
 * @return	string	la définition mysql
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
 * Default field attributes for Decimal	
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