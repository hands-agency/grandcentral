<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrI18n extends attrArray
{
	protected $field;
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function is_empty()
	{
		foreach ((array) $this->data as $data)
		{
			if (!empty($data)) return false;
		}
		return true;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function cut($length, $add = '...')
	{
		$str = strip_tags($this->__tostring());
		
		if (mb_strlen($str) > $length)
		{
		//	On coupe
			$string = mb_substr($str, 0, $length);
		//	On enlève le dernier mot
			$string = substr($string, 0, -(mb_strlen(mb_strrchr($string, ' '))));
		//	On ajoute les ...
			$string .= $add;
		}
		else
		{
			$string = $str;
		}
		return $string;
	}
/**
 * Get complete item url
 *
 * @return	string	url
 * @access	public
 */
	public function attach(_items &$item)
	{
		// print'<pre>';print_r($item);print'</pre>';
		$this->params['table'] = $item->get_table();
		$this->params['env'] = $item->get_env();
		// $this->params['key'] = $item['key']->get();
	}
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
 * Définir le type du champ à internationaliser
 * 
 * @return	string	le nom du champ
 * @access	public
 */
	public function set_attr($attr)
	{
		$this->attr = $attr;
	}
/**
 * Définir le type du champ à internationaliser
 * 
 * @return	string	le nom du champ
 * @access	public
 */
	public function get_attr($attr)
	{
		return $this->attr;
	}
/**
 * Afficher le contenu de l'attribut
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __tostring()
	{
		if (empty($this->params['env'])) $this->params['env'] = env;
		//	HACK à refaire
		switch (true)
		{
			case $this->is_empty():
			case empty($this->data[i($this->params['env'], current)['version']['lang']->get()]):
				return '';
				break;
			case $this->field == 'fieldSirtrevor':
				$attr = new attrSirtrevor($this->data[i($this->params['env'], current)['version']['lang']->get()]);
				return $attr->__tostring();
				break;
			case is_string($this->data):
				return $this->data;
				break;
			default:
				return $this->data[i($this->params['env'], current)['version']['lang']->get()];
				break;
		}
	}
/**
 * Default field attributes for Decimal	
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public static function get_properties()
	{
		// old
		$available = registry::get_class('field');
		//	Get the properties for each attr
		foreach ($available as $field) $fields[$field] = mb_substr(mb_strtolower($field), 5);
		//	Start with the default for all properties
		$params = parent::get_properties();
		//	Somes specifics for this attr
		$params['field'] = array(
			'placeholder' => '...',
			'name' => 'field',
			'type' => 'select',
			'label' => 'Type (deprecated)',
			'values' => $fields,
			'valuestype' => 'array'
		);
		// new
		$available = registry::get_class('attr');
		//	Get the properties for each attr
		foreach ($available as $attr) $attrs[$attr] = mb_substr(mb_strtolower($attr), 4);
		unset($attrs['attrI18n']);
		//	Start with the default for all properties
		// $params = parent::get_properties();
		//	Somes specifics for this attr
		$params['attr'] = array(
			'name' => 'attr',
			'type' => 'select',
			'label' => 'Attr',
			'values' => $attrs,
			'valuestype' => 'array'
		);
		//	Return
		return $params;
	}
}
?>