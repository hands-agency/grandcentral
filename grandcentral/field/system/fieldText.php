<?php
/**
 * Classe du champ text
 *
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldText extends _fieldsInput
{
	protected $autocomplete = false;
	protected $regexp;
	protected $datalist = false;
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
 * Affecte un liste de choix à l'input
 *
 * @param	array ou bunch	la liste à afficher
 * @access	public
 */
	public function set_datalist($array)
	{
		$this->attrs['list'] = 'list'.$this->get_name();
		$this->datalist = $array;
		return $this;
	}
/**
 * Obtenir la liste des suggestions
 *
 * @return	array	la liste de suggestions
 * @access	public
 */
	public function get_datalist()
	{
		return $this->datalist;
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
 * Obtenir la liste de tous les attributs du champ
 *
 * @return	array	le tableau des attributs du champ
 * @access	public
 */
	public function get_attrs()
	{
		if (isset($this->attrs['value'])) $this->attrs['value'] = str_replace('"','&quot;',$this->attrs['value']);
		return parent::get_attrs();
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
		$properties['autocomplete'] = 'bool';
		$properties['regexp'] = 'text';

		return $properties;
	}
}
?>
