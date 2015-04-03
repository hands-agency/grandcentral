<?php
/**
 * Classe du champ number
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldNumber extends _fieldsInput
{
	protected $datatype = array('int', 'decimal');
	protected $step;
/**
 * Créer un champ number
 *
 * @param	string	le nom du champ
 * @param	array	le tableau de paramètres du champ
 * @access	public
 */
	public function __construct($name, $attrs = null)
	{
		parent::__construct($name, $attrs);
		$this->attrs['type'] = 'number';
	}
/**
 * Affecte une valeur au champ
 * 
 * @param	mixed	la valeur
 * @access	public
 */
	public function set_value($value)
	{
		if (ctype_digit((string)$value))
		{
			$this->value = $value;
			$this->attrs['value'] = $this->get_cleaned_value($value);
		}
	}
/**
 * Définit le pas du champ
 * 
 * @param	mixed	la valeur du pas
 * @access	public
 */
	public function set_step($value)
	{
		$this->attrs['step'] = $value;
	}
/**
 * Obtenir la définition des propriétés du champ
 * 
 * @return	array 	la liste des propriétés et leurs définitions
 * @access	public
 * @static
 */
	public static function get_properties()
	{
		$properties = parent::get_properties();
		$properties['step'] = 'number';
		
		return $properties;
	}
}
?>