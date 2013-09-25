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
		$app = new app('media');
		
		$url = $app->get_templateurl().$root;
		$root = $app->get_templateroot().$root;
		parent::__construct($root);
		$this->url = $url;
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