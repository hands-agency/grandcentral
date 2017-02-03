<?php
/**
 * Date attribute handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrDate extends _attrs
{
	protected $data = '0000-00-00 00:00:00';
	protected $params = array(
		'type' => 'datetime'
	);
/**
 * Set the data into the attribute.
 *
 * @param	mixed	attribute data
 * @access	public
 */
	public function set($data)
	{
		$this->data = (empty($data)) ? '0000-00-00 00:00:00' : $data;
		return $this;
	}
/**
 * Check if the attribute data is empty
 *
 * @return	bool	true if is empty, false otherwise
 * @access	public
 */
	public function is_empty()
	{
		return (empty($this->data) || $this->data == '0000-00-00 00:00:00') ? true : false;
	}
/**
 * Returns date formatted according to given format.
 * Uses php [Datetime::format](http://php.net/manual/en/datetime.format.php) method.
 *
 * @param	string	Format accepted by [date()](http://php.net/manual/en/function.date.php)
 * @return	string	Returns the formatted date string on success or FALSE on failure.
 * @access	public
 */
	public function format($format)
	{
		$date = new DateTime($this->data);
		return $date->format($format);
	}
/**
 * Returns date difference
 * Uses php [Datetime::diff](http://php.net/manual/en/datetime.diff.php) method.
 *
 * @param	string	Format accepted by [date()](http://php.net/manual/en/function.date.php)
 * @return	string	Returns the date difference
 * @access	public
 */
	public function diff($from)
	{
		$date = new DateTime($this->data);
		$from = new DateTime($from);
		return $date->diff($from);
	}
/**
 * Alter the timestamp of a DateTime object by incrementing or decrementing in a format accepted by strtotime().
 * Uses php [Datetime::modify](http://php.net/manual/en/datetime.modify.php) method
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function modify($modif)
	{
		$date = new DateTime($this->data);
		return $date->modify($modif);
	}
/**
 * Get mysql attribute definition
 *
 * @return	string	a mysql string
 * @access	public
 */
	public function mysql_definition()
	{
		if (!isset($this->params['format']) || empty($this->params['format'])) $this->params['format'] = 'datetime';
	//	definition
		$definition = '`'.$this->params['key'].'` '.$this->params['format'].' NOT NULL';
	//	retour
		return $definition;
	}
/**
 * Format the attribute date using the current date
 *
 * @return	string	formatted date
 * @access	public
 */
	public function time_since()
	{
		$timeFirst  = strtotime($this->data);
		$timeSecond = strtotime(date('Y-m-d H:i:s'));
		$since = $timeSecond - $timeFirst;
	
	//	Just now (< 30 second ago)
		if ($since < 30) $return = cst('Just now');
		
	//	Otherwise
		else
		{
			$chunks = array(
				array(60 * 60 * 24 * 365 , t('year')),
				array(60 * 60 * 24 * 30 , t('month')),
				array(60 * 60 * 24 * 7, t('week')),
				array(60 * 60 * 24 , t('day')),
				array(60 * 60 , t('hour')),
				array(60 , t('minute')),
				array(1 , t('second'))
			);

			for ($i = 0, $j = count($chunks); $i < $j; $i++)
			{
				$seconds = $chunks[$i][0];
				$name = $chunks[$i][1];
				if (($count = floor($since / $seconds)) != 0) break;
			}

		    $return = ($count == 1) ? '1 '.$name : $count.' '.$name.'s';
		}
	//	Return
	    return $return;
	}
	
/**
 * Get the properties of an attributes
 *
 * @return	array	an array of attribute properties
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