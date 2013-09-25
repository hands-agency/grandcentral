<?php
/**
 * Classe du champ checkbox
 * 
 * Affiche une liste de checkboxes
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class field_checkbox extends _fields_selector
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

/**
 * Construit le code html du champ checkbox
 * 
 * @return	string	le html du champ
 * @access	public
 */
	public function __toString()
	{
	//	Some vars
		$label = '';
		$li = '';

		if ($values = $this->prepare_values())
		{
			foreach ($values as $k => $v)
			{
				if (!isset($v['id']))
				{
					$li .= '<li class="divider">('.htmlspecialchars($k).')</li>';
					foreach ($v as $vv)
					{
						$li .= $this->_option($vv);
					}
				}
				else
				{
					$li .= $this->_option($v);
				}
			}
		//	<label>
			if (!empty($this->label))
			{
				$label = '<label for="'.$this->attrs['name'].'">'.$this->label.'</label>';
			}
		}
	//	Return
		return $label.'<span class="'.$this->containerclass.'"><ul>'.$li.'</ul></span>';
	}
}

?>