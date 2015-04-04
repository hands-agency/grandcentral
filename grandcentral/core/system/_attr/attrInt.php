<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
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
	public function mysql_definition()
	{
		if (!isset($this->params['max'])) $this->params['max'] = 0;
		if (!isset($this->params['min'])) $this->params['min'] = 0;
	//	type mysql unsigned (nombre entier positif)
		if ($this->params['min'] >= 0)
		{
			switch ($this->params['max'])
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
			switch ($this->params['max'])
			{
				case 0:
					$type = 'int(4)';
					break;
				case $this->params['max'] <= 127 && $this->params['min'] >= -128:
					$type = 'tinyint(1)';
					break;
				case $this->params['max'] <= 32767 && $this->params['min'] >= -32768:
					$type = 'smallint(2)';
					break;
				case $this->params['max'] <= 8388607 && $this->params['min'] >= -8388608:
					$type = 'mediumint(3)';
					break;
				case $this->params['max'] <= 2147483647 && $this->params['min'] >= -2147483648:
					$type = 'int(4)';
					break;
				case $this->params['max'] > 2147483647 && $this->params['min'] < -2147483648:
					$type = 'bigint(8)';
					break;
			}
		}
	//	definition
		$definition = '`'.$this->params['key'].'` '.$type.' NOT NULL';
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
		
		$params['key']['value'] = 'id';
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