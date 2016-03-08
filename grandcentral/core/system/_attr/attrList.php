<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrList extends _attrs
{
	protected $values;
	protected $placeholder;
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	/**
	 * Get the attribute data
	 *
	 * @return	mixed	 attribute data value
	 * @access	public
	 */

	public function get_data()
	{
		return $this->data;
	}


	public function set($data)
	{
		$this->data = (string) $data;
		// if (is_array($this->values) && in_array($data, $this->values))
		// {
			// $this->data = (string) $data;
		// }
		// return $this;
	}
/**
 * Ajouter la liste des valeurs disponibles
 *
 * @param	string	la liste des valeurs (ex : bird, dog, cat)
 * @return	array	la liste des valeurs au format array
 * @access	public
 */
	public function set_values($data)
	{
		$this->values = array_map('trim', explode(',', $data));
	//	retour
		return $this;
	}
/**
 * Implémenter la valeur du placeholder
 *
 * @param	string	la valeur du placeholder
 * @return	array	la liste des valeurs au format array
 * @access	public
 */
	public function set_placeholder($data)
	{
		$this->placeholder = $data;
	//	retour
		return $this;
	}
/**
 * Retourne la liste des valeurs disponibles
 *
 * @return	field	l'objet fieldSelect
 * @access	public
 */
	public function get_values()
	{
		return $this->values;
	}
/**
 * Retourne la liste des valeurs disponibles
 *
 * @return	field	l'objet fieldSelect
 * @access	public
 */
	public function get_placeholder()
	{
		return $this->placeholder;
	}
/**
 * Definition mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` varchar(32) CHARACTER SET '.database::charset.' COLLATE '.database::collation.'';
	//	retour
		return $definition;
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
		$params['values'] = array(
			'name' => 'values',
			'type' => 'text',
			'label' => 'Ex: dog,cat,bird'
		);
		$params['placeholder'] = array(
			'name' => 'placeholder',
			'type' => 'text',
			'label' => 'Placeholder'
		);
	//	Return
		return $params;
	}
}
?>