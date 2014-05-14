<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrI18n extends attrArray
{
	protected $field;
/**
 * Définir le type du champ à internationaliser
 * 
 * @return	string	le nom du champ
 * @access	public
 */
	public function set_field($field)
	{
		$this->field = $field;
	}
/**
 * Obtenir le type du champ
 * 
 * @return	string	le nom du champ
 * @access	public
 */
	public function get_field()
	{
		return $this->field;
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
		return $this->data[i(env, current)['version']['lang']->get()];
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
		$available = registry::get_class('field');
		//	Get the properties for each attr
		foreach ($available as $field) $fields[$field] = mb_substr(mb_strtolower($field), 5);
		//	Start with the default for all properties
		$params = parent::get_properties();
		//	Somes specifics for this attr
		$params['field'] = array(
			'name' => 'field',
			'type' => 'select',
			'label' => 'Type',
			'values' => $fields,
			'valuestype' => 'array'
		);
		//	Return
		return $params;
	}
}
?>