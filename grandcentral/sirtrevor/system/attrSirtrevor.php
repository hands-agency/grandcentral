<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrSirtrevor extends _attrs implements ArrayAccess
{	
/**
 * Set array attribute
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
 * Definition mysql
 * ex : `param` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` varchar(5000) CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
	
/**
 * Get array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __toString()
	{
	//	Some vars
		$return = null;
	//	Decode json stored as a string
		$json = json_decode($this->get(), true);
		
		sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $json);
		
	//	Loop through blocks
		foreach ($json['data'] as $block)
		{
		//	Markdown to HTML
			$text = Markdown::defaultTransform($block['data']['text']);
			
		//	HTML formatting
			switch ($block['type'])
			{
			//	Text
				case 'text':
					$return .= str_replace("\n", "</p>\n<p>", '<p>'.$text.'</p>');
					break;
			//	Heading
				case 'heading':
					$return .= '<h2>'.$text.'</h2>';
					break;
			//	List
				case 'list':
					$return .= $text;
					break;
			}
		}
		
	//	Return
		return $return;
	}

/**
 * ArrayAccess Interface methods
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) $this->data[] = $value;
		else $this->data[$offset] = $value;
	}
	public function offsetExists($offset)
	{
		return isset($this->data[$offset]);
	}
	public function offsetUnset($offset)
	{
		unset($this->data[$offset]);
	}
	public function offsetGet($offset)
	{
		return isset($this->data[$offset]) ? $this->data[$offset] : null;
	}
	
/**
 * Default field attributes for Array	
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
	/*
		$params['blockTypes'] = array();
		$params['defaultType'] = array();
		$params['blockLimit'] = array();
		$params['blockTypeLimits'] = array();
		$params['onEditorRender'] = array();
	*/
	//	Return
		return $params;
	}
}
?>