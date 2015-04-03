<?php
/**
 * Classe du champ media
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldFile extends _fields
{
	protected $datatype = array('array');
	protected $mediatype;
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
		$this->attrs['type'] = 'file';
	}	
/**
 * Affecte les types de médias autorisés
 * 
 * @param	array	les tableau des types
 * @access	public
 */
	public function set_mediatype($value)
	{
		$this->mediatype = (array) $value;
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
		$properties['mediatype'] = 'array';
		
		return $properties;
	}
}
?>