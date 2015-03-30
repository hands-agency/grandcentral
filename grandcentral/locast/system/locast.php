<?php
/**
 * The group item of Grand Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://grandcentral.fr
 */
class locast
{
	protected $url;
	public $data;
	
/**
 * Class constructor
 *
 * @param	string  only site
 * @access	public
 */
	public function __construct($url)
	{
	//	Some vars
		$this->url = $url;
	}
	
/**
 * Returns the data of a specific cast
 *
 * @param	int 
 * @access	public
 */
	public function get_cast($castid = null)
	{
		$json = file_get_contents($this->url.$castid);
		return $this->data = json_decode($json);
	}
}
?>