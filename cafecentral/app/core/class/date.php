<?php
/**
 * Date
 * 
 * Handles dates
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class date
{
	public $date;
	
/**
 * Constructeur de classe
 * 
 * @access	public
 */
	public function __construct($date)
	{
		$this->date = $date;
	}
		
/**
 * Get the time spent since the date
 *
 * @access	public
 */
	public function time_since()
	{
		$timeFirst  = strtotime($this->date);
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
}
?>