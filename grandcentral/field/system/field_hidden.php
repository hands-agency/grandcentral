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
class field_hidden extends _fields_input
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
 * Construit le code html du champ input
 * 
 * @return	string	le html du champ
 * @access	public
 */
	public function __toString()
	{
		$attrs = '';
		foreach ($this->attrs as $key => $value)
		{
			$attrs .= ' '.$key.'="'.$value.'"';
		}
		return '<input'.$attrs.'>';
	}
}
?>