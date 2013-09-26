<?php
/**
 * The group item of Café Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class video extends file
{
	protected $width;
	protected $height;

	/**
	 * Prints the image in a <img tag>
	 *
	 * @access	public
	 */
		public function __tostring()
		{
			return '<video><source src="'.$this->get_url().'" type="video/mp4"><source src="'.$this->get_url().'" type="video/ogg">Your browser does not support the video tag.</video>';
		}
}
?>