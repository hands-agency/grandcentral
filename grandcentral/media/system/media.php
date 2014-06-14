<?php
/**
 * The group item of Café Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class media extends file
{
/**
 * Returns the path of the media
 *
 * @param	string  le chemin de l'objet
 * @access	public
 */
	public function get_path()
	{
		$path = mb_substr($this->get_root(), mb_strpos($this->get_root(), '/media') + 6);
		
		return $path;
	}

	public function __call($method, $args)
	{
		trigger_error('I\'m just a simple media object. You can\'t call '.$method.'. Are you sure i exist.', E_USER_WARNING);
	}
}
?>