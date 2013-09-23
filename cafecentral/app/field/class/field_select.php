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
class field_select extends _fields_selector
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
		$selected = ($this->value == $param['id'] || $this->value[0] == $param['id']) ? ' selected="selected"' : '';
		$option = '<option value="'.htmlspecialchars($param['id']).'"'.$selected.'>'.$param['title'].'</option>';
		return $option;
	}
/**
 * Construit le code html du champ radio
 * 
 * @return	string	le html du champ
 * @access	public
 */
	public function __toString()
	{
		$attrs = '';
		$label = '';
		$options = '';
		
	//	Placeholder
		if (isset($this->attrs['placeholder']))
		{
			$options .= '<option value="">'.$this->attrs['placeholder'].'</option>';
		}
		unset($this->attrs['placeholder']);
		
	//	Empty value for not required
		if (isset($this->attrs['required']))
		{
			$options .= '<option value="">(nodata)</option>';
		}
		unset($this->attrs['required']);
		
		$values = $this->prepare_values();
		
	//	Some values
		if ($values)
		{
			foreach ($values as $k => $v)
			{
				if (!isset($v['id']))
				{
					$options .= '<optgroup label="'.htmlspecialchars($k).'">';
					foreach ($v as $vv)
					{
						$options .= $this->_option($vv);
					}
				}
				else
				{
					$options .= $this->_option($v);
				}
			}	
		}
		foreach ($this->attrs as $key => $value)
		{
			$attrs .= ' '.$key.'="'.$value.'"';
		}
		if (!empty($this->label))
		{
			$label = '<label for="'.$this->attrs['name'].'">'.$this->label.'</label>';
		}
		return $label.'<span class="'.$this->containerclass.'"><select'.$attrs.'>'.$options.'</select></span>';
	}
}
?>