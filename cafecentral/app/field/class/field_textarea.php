<?php
/**
 * Classe du champ textarea
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class field_textarea extends _fields
{
	protected $datatype = array('string');
/**
 * Créer un champ de type textarea
 * 
 * @param	string	le nom du champ
 * @param	array	le tableau de paramètres du champ
 * @access	public
 */
	public function __construct($name, $attrs = null)
	{
		parent::__construct($name, $attrs);
	}
/**
 * Obtenir la valeur nettoyée du champ (pour un affichage sécurisé)
 * 
 * @return	string	le nom propre du champ
 * @access	public
 */
	public function get_cleaned_value($value)
	{
		$value = trim($value);
		$value = htmlspecialchars($value);
		$value = preg_replace('`[\x00\x08-\x0b\x0c\x0e\x19]`i', '', $value);
		return parent::get_cleaned_value($value);
	}
/**
 * Construit le code html du champ textarea
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
		return $label.'<span class="'.$this->containerclass.'"><textarea'.$attrs.' >'.$this->get_cleaned_value($this->value).'</textarea></span>';
	}
}
?>