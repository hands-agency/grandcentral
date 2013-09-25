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
	protected $path;
/**
 * Crée un objet "fichier" défini par son chemin
 *
 * @param	string  le chemin de l'objet
 * @access	public
 */	
	public function __construct($root)
	{
		$this->path = $root;
		if (!strstr($root, SITE_THEME_RELATIVE_ROOT)) $root = SITE_THEME_ROOT.'/media'.$root;
		parent::__construct($root);
	}
	
/**
 * Returns the path of the media
 *
 * @param	string  le chemin de l'objet
 * @access	public
 */
	public function get_path()
	{
		return $this->path;
	}

/**
 * Find the # of uses of this media
 *
 * @param	string  le chemin de l'objet
 * @access	public
 */
	public function get_uses()
	{
		return 'TODO';
	}
}
?>