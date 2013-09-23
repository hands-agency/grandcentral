<?php
/**
 * Classe abstaire de manipulation des champs input
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 * @abstract
 */
abstract class _fields_input extends _fields
{
/**
 * Créer un nouveau champ et le peupler de ses attributs
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
 * Affecte un maximum requis au champ
 * 
 * @param	string	le maximum
 * @access	public
 */
	public function set_max($value)
	{
		parent::set_max($value);
		if (ctype_digit((string)$value) && $value > 0)
		{
			$this->attrs['maxlength'] = $value;
		}
		else
		{
			unset($this->attrs['maxlength']);
		}
		return $this;
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
		$value = preg_replace('`[\x00-\x19]`i', '', $value);
		return parent::get_cleaned_value($value);
	}
/**
 * Vérifie la validité de la valeur du champ
 * 
 * @param	mixed	la valeur du champ
 * @return	bool	true ou false
 * @access	public
 */
	public function is_valid()
	{
		$valid = parent::is_valid();
		
		if (isset($this->attrs['maxlength']) && isset($this->value[$this->attrs['maxlength']]))
		{
			$this->_error('max');
			$valid = false;
		}
		if (isset($this->min) && !isset($this->value[$this->min]))
		{
			$this->_error('min');
			$valid = false;
		}
		
		return $valid;
	}
/**
 * Construit le code html du champ input
 * 
 * @return	string	le html du champ
 * @access	public
 */
	public function __tostring()
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
		return $label.'<span class="'.$this->containerclass.'"><input'.$attrs.' /></span>';
	}
}
?>