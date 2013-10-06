<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrDate extends _attrs
{
	protected $params = array(
		'type' => 'datetime'
	);
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (empty($data)) ? '0000-00-00 00:00:00' : $data;
		return $this;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function format($format)
	{
		$date = new DateTime($this->data);
		return $date->format($format);
	}
/**
 * Definition mysql
 * ex : `datetimeinsert` datetime NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public static function mysql_definition($attr)
	{
		if (!isset($attr['format']) || empty($attr['format'])) $attr['format'] = 'datetime';
	//	definition
		$definition = '`'.$attr['key'].'` '.$attr['format'].' NOT NULL';
	//	retour
		return $definition;
	}
/**
 * Definition mysql
 * ex : `datetimeinsert` datetime NOT NULL
 *
 * @param	array 	le tableau de paramètres
 * @return	string	la définition mysql
 * @access	public
 * @static
 */
	public function time_since()
	{
		$timeFirst  = strtotime($this->data);
		$timeSecond = strtotime(date('Y-m-d H:i:s'));
		$since = $timeSecond - $timeFirst;
	
	//	Just now (< 30 second ago)
		if ($since < 30) $return = DATE_NOW;
		
	//	Otherwise
		else
		{
			$chunks = array(
				array(60 * 60 * 24 * 365 , DATE_YEAR),
				array(60 * 60 * 24 * 30 , DATE_MONTH),
				array(60 * 60 * 24 * 7, DATE_WEEK),
				array(60 * 60 * 24 , DATE_DAY),
				array(60 * 60 , DATE_HOUR),
				array(60 , DATE_MINUTE),
				array(1 , DATE_SECOND)
			);

			for ($i = 0, $j = count($chunks); $i < $j; $i++)
			{
				$seconds = $chunks[$i][0];
				$name = $chunks[$i][1];
				if (($count = floor($since / $seconds)) != 0) break;
			}

		    $return = ($count == 1) ? '1 '.$name : "$count {$name}s";
		}
	//	Return
	    return $return;
	}
	
/**
 * Default field attributes for Date	
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
		$params['format'] = array(
			'name' => 'format',
			'type' => 'select',
			'label' => 'Format',
			'valuestype' => 'array',
			'values' => array('datetime', 'date')
		);
	//	Return
		return $params;
	}
}
?>