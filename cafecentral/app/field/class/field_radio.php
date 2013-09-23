<?php
/**
 * Classe du champ radio
 * 
 * Affiche une liste de radios
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class field_radio extends _fields_selector
{
	protected $datatype = array('rel, string');
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
				<input type="radio" value="'.htmlspecialchars($param['id']).'"'.$attrs.$checked.'/>
				<label for="'.$l.'">
					<span class="title">'.htmlspecialchars($param['title']).'</span>
					'.$descr.'
				</label>
			</li>';
		return $li;
	}
/**
 * Construit le code html du champ radio
 * 
 * @return	string	le html du champ
 * @access	public
 */
	public function __toString()
	{
	//	Some vars
		$label = '';
		$li = '';

		$values = $this->prepare_values();
		
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
		return $label.'<span class="'.$this->containerclass.'"><ul>'.$li.'</ul></span>';
	}
/**
 * Obtenir la définition des propriétés du champ
 * 
 * @return	array 	la liste des propriétés et leurs définitions
 * @access	public
 * @static
 */
	public static function get_defined_properties()
	{
		$properties = parent::get_defined_properties();
		unset($properties['min']);
		unset($properties['max']);	
		return $properties;
	}
}
?>