<?php
/**
 * Classe du champ text
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class field_text extends _fields_input
{
	protected $autocomplete = false;
	protected $regexp;
	protected $datatype = array('string');
/**
 * Créer un nouveau champ text et le peupler de ses attributs
 *
 * ex :
 * $param = array(
 * 	'label' => 'The title',
 * 	'descr' => 'Put here the short title',
 * 	'value' => 'Home',
 * 	'cssclass' => 'title',
 * 	'placeholder' => 'Give me a title',
 * 	'required' => true,
 * 	'disabled' => false,
 * 	'readonly' => true,
 * 	'min' => 5,
 * 	'max' => 30,
 * 	...
 * );
 * new field_text('title', $param);
 * 
 * @param	string	le nom du champ
 * @param	array	le tableau de paramètres du champ
 * @access	public
 */
	public function __construct($name, $attrs = null)
	{
		parent::__construct($name, $attrs);
		$this->attrs['type'] = 'text';
	}
/**
 * Définit la valeur de l'attribut autocomplete du champ
 *
 * @param	bool	true pour activer sinon fals
 * @access	public
 */
	public function set_autocomplete($bool = true)
	{
		$bool = (bool) $bool;
		if (false === $bool) { $this->attrs['autocomplete'] = 'off'; $this->autocomplete = false; }
		else { $this->attrs['autocomplete'] = 'on'; $this->autocomplete = true; }
		return $this;
	}
/**
 * Affecte une regexp pour la validation du champ
 *
 * @param	string	la regexp de vérification de la valeur du champ
 * @access	public
 */
	public function set_regexp($value)
	{
		$this->regexp = $value;
		return $this;
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
		$properties['autocomplete'] = 'bool';
		$properties['regexp'] = 'text';
		
		return $properties;
	}
}
?>