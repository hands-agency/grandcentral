<?php
/**
 * Classe du champ hidden
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class fieldHidden extends _fieldsInput
{
/**
 * Créer un champ hidden
 *
 * @param	string	le nom du champ
 * @param	array	le tableau de paramètres du champ
 * @access	public
 */
	public function __construct($name, $attrs = null)
	{
		parent::__construct($name, $attrs);
		$this->attrs['type'] = 'hidden';
	}
/**
 * Affecte une valeur au champ
 * 
 * @param	mixed	la valeur
 * @access	public
 */
	public function set_value($value)
	{
		if (!empty($value))
		{
			$this->value = $value;
		}
		return $this;
	}
}
?>