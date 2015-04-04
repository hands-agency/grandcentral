<?php
/**
 * Classe du champ select
 * 
 * Affiche une liste sous forme de select
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldSelect extends _fieldsSelector
{
	protected $datatype = array('rel, string');
/**
 * Affecte une valeur au champ. Les valeurs des sélecteurs peuvent être des dérivés de _item ou des string de type page_1
 * 
 * @param	mixed	un objet ou un tag d'objet (ex : page_1)
 * @access	public
 */
	public function set_value($value)
	{
		parent::set_value($value);
		if (is_array($this->value) && !empty($this->value))
		{
			$this->value = array_values($this->value)[0];
		}
		return $this;
	}
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