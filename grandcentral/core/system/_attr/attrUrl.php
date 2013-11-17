<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrUrl extends _attrs
{
	protected $item;
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_get()
	{
		if (empty($this->data))
		{
			$this->data = $this->_slugify($this->item['title']->get());
		}
		$this->data = preg_replace('#(\[[^\]]*\])#', '', $this->data);
	//	nettoyage des [] existants
		if ($this->item['status']->get() != 'live')
		{
			$slug = new slug();
			$this->data .= '['.$slug->makeSlugs($this->item['status']->get()).']';
		}
		return $this->data;
	}
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (string) $data;
		return $this;
	}
/**
 * Get complete item url
 *
 * @return	string	url
 * @access	public
 */
	public function attach(_items $item)
	{
		$this->item = $item;
	}
/**
 * php http_build_query() on url
 *
 * @param	array	get arguments
 * @return	string	url
 * @access	public
 */
	public function args($arg)
	{
		// print'<pre>';print_r($arg);print'</pre>';
		$url = $this->__tostring();
		$url .= (!empty($arg)) ? '?'.http_build_query($arg) : '';
		return $url;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __tostring()
	{
		$readerUrl = ($this->item->get_table() == 'page') ? '' : registry::get(registry::reader_index, $this->item->get_table(), 'url');
		$readerUrl = ($readerUrl == '/') ? '' : $readerUrl;
		return constant(mb_strtoupper($this->item->get_env()).'_URL').$readerUrl.$this->get();
	}
/**
 * Definition mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` varchar(255) CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
/**
 * 
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	protected function _slugify($string)
	{
		$string = trim(trim($string), '-');
		
		if (mb_substr($string, 0, 1) == '/')
		{
			$string = mb_substr($string, 1);
		}
		
		$slug = new slug();
		return '/'.$slug->makeSlugs($string);
	}
/**
 * Default field attributes for updated	
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		# $params['somefield'] = array();
		$params['key']['value'] = 'url';
		$params['key']['readonly'] = true;
		unset($params['required']);
	//	Return
		return $params;
	}
}
?>