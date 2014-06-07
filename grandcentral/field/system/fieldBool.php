<?php
/**
 * Classe du champ bool
 * 
 * Affiche une checkbox unique
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class fieldBool extends _fields
{
	protected $datatype = array('bool');
	protected $attrs;
/**
 * Créer un champ de type booléan et le peupler de ses attributs
 *
 * ex :
 * $param = array(
 * 	'label' => 'Etes-vous d'accord avec les conditions générales de ventes ?',
 * 	'cssclass' => 'optin',
 * 	'required' => true,
 * 	'disabled' => false,
 * );
 * new field_bool('optin', $param);
 * 
 * @param	string	le nom du champ
 * @param	array	le tableau de paramètres du champ
 * @access	public
 */
	public function __construct($name, $attrs = null)
	{
		parent::__construct($name, $attrs);
		$this->attrs['type'] = 'checkbox';
		$this->attrs['value'] = 1;
	}
/**
 * Affecte une valeur au champ
 * 
 * @param	bool	true ou false
 * @access	public
 */
	public function set_value($value)
	{
		if (is_a($value, 'attrBool')) $value = $value->get();
		$value = (bool) $value;
		if (true === $value)
		{
			$this->attrs['checked'] = 'checked';
		}
		else
		{
			unset($this->attrs['checked']);
		}
		$this->value = $value;
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
		unset($properties['min']);
		unset($properties['max']);
		unset($properties['placeholder']);
		$properties['labelbefore'] = 'bool';
		return $properties;
	}
}
?>