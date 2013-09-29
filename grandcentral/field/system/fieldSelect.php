<?php
/**
 * Classe du champ select
 * 
 * Affiche une liste sous forme de select
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class fieldSelect extends _fieldsSelector
{
	protected $datatype = array('rel, string');
	
/**
 * Affecte un placeholder au champ
 * 
 * @param	string	le placeholder
 * @access	public
 */
	public function set_placeholder($text)
	{
		if (!empty($text)) $this->attrs['placeholder'] = $text;
		return $this;
	}
/**
 * Retourne le placeholder au champ
 * 
 * @return	string	le placeholder
 * @access	public
 */
	public function get_placeholder()
	{
		return (isset($this->attrs['placeholder'])) ? $this->attrs['placeholder'] : '';
	}
/**
 * Crée le html d'un élément du sélecteur
 *
 * @param	array	le tableau de paramètres de l'élément de la liste
 * @access	protected
 */
	protected function _option($param)
	{
		$selected = ($this->value == $param['id'] || $this->value[0] == $param['id']) ? ' selected="selected"' : '';
		$option = '<option value="'.htmlspecialchars($param['id']).'"'.$selected.'>'.$param['title'].'</option>';
		return $option;
	}
}
?>