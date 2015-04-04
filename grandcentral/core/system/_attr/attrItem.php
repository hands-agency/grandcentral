<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrItem extends _attrs
{
/**
 * Set attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function unfold()
	{
		return i($this->data, null, $this->params['env']);
	}
/**
 * Set attribute
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
		$this->params['env'] = $item->get_env();
		$this->params['table'] = $item->get_table();
		$this->params['id'] = $item['id']->get();
	}
/**
 * Definition mysqld
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` varchar(64) CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
/**
 * Definition index mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_index_definition()
	{
	//	definition
		$definition = 'KEY `'.$this->params['key'].'` (`'.$this->params['key'].'`)';
	//	retour
		return $definition;
	}
/**
 * Default field attributes for Version	
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
		$params['rel'] = array(
            'name' => 'param',
            'type' => 'bunch',
            'label' => 'Build your list of items',
        );
	//	Return
		return $params;
	}
}
?>