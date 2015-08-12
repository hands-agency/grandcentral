<?php
/**
 * Classe du champ multipleselect
 * 
 * Permet d'afficher un sélecteur permettant, par drag and drop, de sélectionner une liste de valeurs et de les ordonner
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldZoning extends _fieldsSelector
{
	protected $datatype = array('rel');
/**
 * Check if a field is correctly filled
 * 
 * @return	bool	true ou false
 * @access	public
 */
	public function is_valid()
	{
		$valid = parent::is_valid();
		
		return true;
	}
}
?>