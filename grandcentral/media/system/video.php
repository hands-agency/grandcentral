<?php
/**
 * The group item of Grand Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class video extends media
{
	protected $width;
	protected $height;
	protected $attr;

	/**
	 * Prints the image in a <img tag>
	 *
	 * @access	public
	 */
		public function __tostring()
		{
		//	Set tag attr
			$a = '';
			foreach ((array)$this->attr as $attr => $value)
			{
				$a .= ' '.$attr;
				if ($value != null) $a .= '="'.$value.'"';
			}
		//	Return
			return '
			<video'.$a.'>
				<source src="'.$this->get_url(true).'" type="video/mp4">
				<source src="'.$this->get_url(true).'" type="video/ogg">
				Your browser does not support the html5 video tag.
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
	
/**
 * Set video attributes
 *
 * @access	public
 */
	public function set_attr($p)
	{
		foreach ($p as $attr => $value) $this->attr[$attr] = $value;
	}
}
?>