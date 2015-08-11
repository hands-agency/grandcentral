<?php
/**
 * Classe du champ textarea
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldSirtrevor extends fieldTextarea
{
	protected $datatype = array('string');
	protected $template = 'field/sirtrevor';
/**
 * Check if a field is correctly filled
 * 
 * @return	bool	true ou false
 * @access	public
 */
	public function is_valid()
	{
		$valid = parent::is_valid();
		
//		$this->_error('max', $this->value);
		$valid = true;
		
		return $valid;
	}
}
?>