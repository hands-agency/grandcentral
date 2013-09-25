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
class field_bool extends _fields
{
	protected $datatype = array('bool');
	protected $attrs = array('value' => true);
	protected $labelbefore = false;
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
	}
/**
 * Affecte une valeur au champ
 * 
 * @param	bool	true ou false
 * @access	public
 */
	public function set_value($value)
	{
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
 * Détermine si le label doit être avant ou après le champ
 * 
 * @param	bool	true ou false (false par défaut)
 * @access	public
 */
	public function set_labelbefore($bool = true)
	{
		$this->labelbefore = (bool) $bool;
		return $this;
	}
/**
 * Affiche le champ
 * 
 * @return	string	le html du champ
 * @access	public
 */
	public function __toString()
	{
		$attrs = '';
		$label = '';
		foreach ($this->attrs as $key => $value)
		{
			$attrs .= ' '.$key.'="'.$value.'"';
		}
		if (!empty($this->label))
		{
			$label = '<label for="'.$this->attrs['name'].'">'.$this->label.'</label>';
		}
		$html = '<span class="'.$this->containerclass.'"><input'.$attrs.'></span>';
		return ($this->labelbefore === true) ? $label.$html : $html.$label;
	}
/**
 * Obtenir la définition des propriétés du champ
 * 
 * @return	array 	la liste des propriétés et leurs définitions
 * @access	public
 * @static
 */
	public static function get_defined_properties()
	{
		$properties = parent::get_defined_properties();
		unset($properties['min']);
		unset($properties['max']);
		unset($properties['placeholder']);
		$properties['labelbefore'] = 'bool';
		return $properties;
	}
}
?>