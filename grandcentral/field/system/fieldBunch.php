<?php
/**
 * Classe du champ bunch
 * 
 * Champ d'édition d'un bunch
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class fieldBunch extends _fields
{
	protected $datatype = false;
	
/**
 * Affecte une valeur au champ
 * 
 * @param	mixed	la valeur
 * @access	public
 */
	public function set_value($value)
	{
		if (is_string($value))
		{
			$value = array(array('table' => $value));
		}
		$this->value = array_values($value);
		return $this;
	}
}
?>