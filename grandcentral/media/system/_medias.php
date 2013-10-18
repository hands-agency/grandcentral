<?php
/**
 * The group item of Café Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
abstract class _medias extends file
{
/**
 * Returns the path of the media
 *
 * @param	string  le chemin de l'objet
 * @access	public
 */
	public function get_path()
	{
		$path = mb_substr($this->get_root(), mb_strpos($this->get_root(), '/media/') + 7);
		
		return $path;
	}

	
}
?>