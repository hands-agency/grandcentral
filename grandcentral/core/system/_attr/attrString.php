<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrString extends _attrs
{
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
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function cut($length, $add = '...')
	{
		if (mb_strlen($this->data) > $length)
		{
		//	On coupe
			$string = mb_substr($this->data, 0, $length);
		//	On enlève le dernier mot
			$string = mb_substr($string, 0, -(mb_strlen(mb_strrchr($string, ' '))));
		//	On ajoute les ...
			$string .= $add;
		}
		else
		{
			$string = $this->data;
		}
		return $string;
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
		$this->params['min'] = (empty($value)) ? 0 : $value;
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
		$this->params['max'] = (empty($value)) ? 5000 : $value;
		return $this;
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
		return htmlspecialchars($this->get(), ENT_QUOTES | ENT_HTML5, 'UTF-8', false);
	}
/**
 * Definition mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
		if (!isset($this->params['max'])) $this->params['max'] = 0;
	//	type mysql
		switch ($this->params['max'])
		{
			case 0:
				$type = 'varchar(5000)';
				break;
			case $this->params['max'] <= 16380:
				$type = 'varchar('.$this->params['max'].')';
				break;
			case $this->params['max'] > 16380:
				$type = 'mediumtext';
				break;
		}
	//	definition
		$definition = '`'.$this->params['key'].'` '.$type.' CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
/**
 * Default field attributes for String
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
			'label' => 'Min',
			'value' => 0
		);
		$params['max'] = array(
			'name' => 'max',
			'type' => 'number',
			'label' => 'Max',
			'value' => 5000
		);
	//	Return
		return $params;
	}
}
?>
