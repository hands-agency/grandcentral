<?php
/**
 * Classe du champ checkbox
 * 
 * Affiche une liste de checkboxes
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class fieldCheckbox extends _fieldsSelector
{
	protected $datatype = array('rel, string');
	protected $values;
	protected $valuestype = 'function';
/**
 * Crée le html d'un élément du sélecteur
 *
 * @param	array	le tableau de paramètres de l'élément de la liste
 * @access	protected
 */
	protected function _option($param)
	{
		$attrs = '';
	//	Is checked?
		$checked = (in_array($param['id'], (array)$this->value)) ? ' checked="checked"' : '';
		$class = (!empty($checked)) ? $class = 'class="on"' : '';
	//	Other attributes
		foreach ($this->attrs as $key => $value)
		{
		//	Change id and name
			if ($key == 'id')
			{
				$value .= $param['id'];
				$l = $value;
			}
			if ($key == 'name') $value .= '[]';
			$attrs .= ' '.$key.'="'.$value.'"';
		}
	//	descr
		$descr = (isset($param['descr']) && !empty($param['descr'])) ? '<span class="descr">'.htmlspecialchars($param['descr']).'</span>' : null;
	//	<li>
		$li = '
		<li '.$class.'>
			<input type="checkbox" value="'.htmlspecialchars($param['id']).'"'.$attrs.$checked.'/>
			<label for="'.$l.'">
				<span class="title">'.htmlspecialchars($param['title']).'</span>
				'.$descr.'
			</label>
		</li>';
	//	Return
		return $li;
	}
}

?>