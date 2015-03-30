<?php
/**
 * The group item of Grand Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://grandcentral.fr
 */
class video extends media
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
			return '
			<video controls>
				<source src="'.$this->get_url(true).'" type="video/mp4">
				<source src="'.$this->get_url(true).'" type="video/ogg">
				Your browser does not support the video tag.
			</video>';
		}
	
/**
 * Retourne le chemin vers le thumbnail
 *
 * @access	public
 */
	public function thumbnail($width, $height, $quality = 75)
	{
		return null;
	}
}
?>