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
class fieldMedia extends _fields
{
	protected $datatype = array('array');
	protected $mediatype;

/**
 * Affecte les types de médias autorisés
 * 
 * @param	array	les tableau des types
 * @access	public
 */
	public function is_valid()
	{
		return true;
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

/**
 * Affecte un placeholder au champ
 * 
 * @param	string	le placeholder
 * @access	public
 */
	public function set_placeholder($text)
	{
		if (!empty($text)) $this->attrs['placeholder'] = $text;
		return $this;
	}

/**
 * Retourne le placeholder au champ
 * 
 * @return	string	le placeholder
 * @access	public
 */
	public function get_placeholder()
	{
		return (isset($this->attrs['placeholder'])) ? $this->attrs['placeholder'] : '';
	}
}
?>