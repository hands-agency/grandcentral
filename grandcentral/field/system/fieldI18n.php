<?php
/**
 * Classe du champ array
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldI18n extends _fields
{
	protected $datatype = array('array');
	protected $field;
/**
 * Définir le type du champ à internationaliser
 * 
 * @return	string	le nom du champ
 * @access	public
 */
	public function set_field($field)
	{
		$this->field = $field;
	}
/**
 * Obtenir le type du champ
 * 
 * @return	string	le nom du champ
 * @access	public
 */
	public function get_field()
	{
		return $this->field;
	}
}
?>