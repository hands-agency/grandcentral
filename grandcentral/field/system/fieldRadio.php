<?php
/**
 * Classe du champ radio
 * 
 * Affiche une liste de radios
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldRadio extends _fieldsSelector
{
	protected $datatype = array('rel, string');
/**
 * Obtenir la liste de tous les attributs du champ
 * 
 * @return	array	le tableau des attributs du champ
 * @access	public
 */
	public function get_attrs()
	{
		return $this->attrs;
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
		return $properties;
	}
}
?>