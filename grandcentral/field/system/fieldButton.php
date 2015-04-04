<?php
/**
 * Classe abstaire de manipulation des champs input
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 * @abstract
 */
class fieldButton extends _fields
{
/**
 * Obtenir la valeur nettoyée du champ (pour un affichage sécurisé)
 * 
 * @return	string	le nom propre du champ
 * @access	public
 */
	public function get_cleaned_value()
	{
		$value = trim($this->value);
		$value = htmlspecialchars($value);
		$value = preg_replace('`[\x00-\x19]`i', '', $value);
		return parent::get_cleaned_value($value);
	}
/**
 * Affecte une valeur au champ
 * 
 * @param	mixed	la valeur
 * @access	public
 */
	public function set_value($value)
	{
		$this->value = $value;
		return $this;
	}
/**
 * Change le type du bouton
 * 
 * @param	mixed	le type dérsiré
 * @access	public
 */
	public function set_buttontype($type)
	{
		$this->attrs['type'] = $type;
		return $this;
	}
/**
 * Change le type du bouton
 * 
 * @param	mixed	le type dérsiré
 * @access	public
 */
	public function get_buttontype($type)
	{
		$this->attrs['type'] = $type;
		return $this;
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
		unset($properties['label']);
		unset($properties['descr']);
		unset($properties['required']);
		unset($properties['placeholder']);
		unset($properties['min']);
		unset($properties['max']);
		unset($properties['containerclass']);
		$properties['buttontype'] = 'text';
		
		return $properties;
	}
}
?>