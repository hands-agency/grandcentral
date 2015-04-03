<?php
/**
 * Internationalization attribute handling class.
 * Work as a container of all other attributes
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrI18n extends attrArray
{
	protected $field;
/**
 * Check if the attribute data is empty
 *
 * @return	bool	true if is empty, false otherwise
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
 * Attach _items data inside attribute
 *
 * @return	_items	item to attach to the attribute
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
 * (deprecated) Field to display inside i18n block
 * 
 * @param	string	fields classname (ex: fieldText, fieldTextarea...)
 * @access	public
 */
	public function set_field($field)
	{
		$this->field = $field;
	}
/**
 * (deprecated) Field displayed inside i18n block
 * 
 * @return	string	fields classname (ex: fieldText, fieldTextarea...)
 * @access	public
 */
	public function get_field()
	{
		return $this->field;
	}
/**
 * Define the attribute to internationalize
 * 
 * @param	string	attribute classname (ex: attrString, attrSirtrevor)
 * @access	public
 */
	public function set_attr($attr)
	{
		$this->attr = $attr;
	}
/**
 * Get the attribute to internationalize
 * 
 * @return	string	attribute classname (ex: attrString, attrSirtrevor)
 * @access	public
 */
	public function get_attr()
	{
		return $this->attr;
	}
/**
 * Display the internationalized attribute
 *
 * @return	string	attribute view
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
 * Get the properties of an attributes
 *
 * @return	array	an array of attribute properties
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