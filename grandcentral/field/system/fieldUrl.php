<?php
/**
 * Classe du champ Url
 *
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldUrl extends _fields
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

/**
 * Check if a field is correctly filled
 *
 * @return	bool	true ou false
 * @access	public
 */
	public function is_valid()
	{
		$valid = parent::is_valid();

	//	Get the original field
		$field = new fieldText($this->get_key());

	//	Check if this field is valid
		return $field->is_valid();
	}
}
?>
