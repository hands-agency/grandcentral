<?php
/**
 * Classe du champ multipleselect
 * 
 * Permet d'afficher un sélecteur permettant, par drag and drop, de sélectionner une liste de valeurs et de les ordonner
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class field_multipleselect extends _fields_selector
{
	protected $datatype = array('rel, string');
}
?>