<?php
/**
 * Classe du champ media
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class field_media extends _fields
{
	protected $datatype = array('array');
	protected $mediatype;
	
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
	public static function get_defined_properties()
	{
		
		$properties = parent::get_defined_properties();
		$properties['mediatype'] = 'array';
		
		return $properties;
	}
}
?>