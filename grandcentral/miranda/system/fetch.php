<?php
/**
 * Fetching data with right handling
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class fetch
{
	private $user;

/**
 * Instantiate a bunch of items
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function __construct($user)
	{
		$this->user = $user;
	}

/**
 * Get the list of accessible casts
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */

/**
 * Get the list of accessible items (a generic function)
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get($table, $param = array())
	{
	//	Author
		$author = ($table == 'cast') ? 'author' : 'owner';
		
	//	Open a bunch
		$items = new bunch();
		
	//	Fetch items depending on group
		switch (true)
		{
		//	Sociologists and admin see everything
			case $this->user->is_a('sociologist'):
			case $this->user->is_a('admin'):
				$items->get($table, $param);
				break;
			
		//	Investigators only see publics and their privates
			case $this->user->is_a('investigator'):
				$items->get($table, array_merge(
					$param,
					array(
						'private' => false,
					)
				));
				$items->get($table, array_merge(
					$param,
					array(
						'private' => true,
						$author => $this->user->get_nickname(),
					)
				));
				break;
		}

	//	Return
		return $items;
	}

/**
 * Get the list of accessible regions
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get_casts($param = array())
	{
		return $this->get('cast', $param);
	}

/**
 * Get the list of accessible regions
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get_regions($param = array())
	{
		return $this->get('region', $param);
	}

/**
 * Get the list of accessible analyses
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get_analyses($param = array())
	{
		return $this->get('analysis', $param);
	}

/**
 * Get the list of accessible brands
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get_brands($param = array())
	{
		return $this->get('brand', $param);
	}

/**
 * Get the list of accessible publics
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get_publics($param = array())
	{
		return $this->get('public', $param);
	}

}
?>