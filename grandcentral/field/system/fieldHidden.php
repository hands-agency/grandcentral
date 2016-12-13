<?php
/**
 * Classe du champ hidden
 *
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
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
