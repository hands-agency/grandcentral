<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrInt extends _attrs
{
/**
 * Set attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (int) $data;
		return $this;
	}
/**
 * Set attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_min($value)
	{
		$this->params['min'] = $value;
		return $this;
	}
/**
 * Set attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_max($value)
	{
		$this->params['max'] = $value;
		return $this;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_index($value)
	{
		if (in_array($value, array('primary', 'unique', 'index')))
		{
			$this->params['index'] = $value;
		}
	}
/**
 * Definition mysql
 * ex : `id` int(9) unsigned NOT NULL AUTO_INCREMENT
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public static function mysql_definition($attr)
	{
		if (!isset($attr['max'])) $attr['max'] = 0;
		if (!isset($attr['min'])) $attr['min'] = 0;
	//	type mysql unsigned (nombre entier positif)
		if ($attr['min'] >= 0)
		{
			switch ($attr['max'])
			{
				case 0:
					$type = 'mediumint(3)';
					break;
				case $attr['max'] <= 255:
					$type = 'tinyint(1)';
					break;
				case $attr['max'] <= 65535:
					$type = 'smallint(2)';
					break;
				case $attr['max'] <= 16777215:
					$type = 'mediumint(3)';
					break;
				case $attr['max'] <= 4294967295:
					$type = 'int(4)';
					break;
				case $attr['max'] > 4294967295:
					$type = 'bigint(8)';
					break;
			}
		//	unsigned
			$type .= ' unsigned';
		}
	//	mysql signed (nombre entier positif et négatif)
		else
		{
			switch ($attr['max'])
			{
				case 0:
					$type = 'int(4)';
					break;
				case $attr['max'] <= 127 && $attr['min'] >= -128:
					$type = 'tinyint(1)';
					break;
				case $attr['max'] <= 32767 && $attr['min'] >= -32768:
					$type = 'smallint(2)';
					break;
				case $attr['max'] <= 8388607 && $attr['min'] >= -8388608:
					$type = 'mediumint(3)';
					break;
				case $attr['max'] <= 2147483647 && $attr['min'] >= -2147483648:
					$type = 'int(4)';
					break;
				case $attr['max'] > 2147483647 && $attr['min'] < -2147483648:
					$type = 'bigint(8)';
					break;
			}
		}
	//	definition
		$definition = '`'.$attr['key'].'` '.$type.' NOT NULL';
	//	auto increment
		if (isset($attr['auto_increment']) && (bool) $attr['auto_increment'] === true)
		{
			$definition .= ' AUTO_INCREMENT';
		}
	//	retour
		return $definition;
	}
	
/**
 * Default field attributes for Int	
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
		$params['min'] = array(
			'name' => 'min',
			'type' => 'number',
			'label' => 'Min'
		);
		$params['max'] = array(
			'name' => 'max',
			'type' => 'number',
			'label' => 'Max'
		);
	//	Return
		return $params;
	}
}
?>