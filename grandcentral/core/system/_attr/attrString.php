<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
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
			$string = substr($string, 0, -(mb_strlen(mb_strrchr($string, ' '))));
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
 * ex : `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public static function mysql_definition($attr)
	{
	//	type mysql
		switch ($attr['max'])
		{
			case 0:
				$type = 'varchar(65535)';
				break;
			case $attr['max'] <= 65535:
				$type = 'varchar('.$attr['max'].')';
				break;
			case $attr['max'] > 65535:
				$type = 'mediumtext';
				break;
		}
	//	definition
		$definition = '`'.$attr['key'].'` '.$type.' CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
}
?>