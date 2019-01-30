<?php
/**
 * Fetching data with right handling
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
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
 * Get the list of accessible items (a generic function)
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get($table, $param = array())
	{
	//	Some vars
		$public = array('const');
		
	//	Author
		$author = ($table == 'cast') ? 'author' : 'owner';
		
	//	Filter some params
		$param['status'] = 'live';
		
	//	Open a bunch
		$items = new bunch();
		
	//	Fetch items depending on group
		switch (true)
		{
		//	Some data is public
			case in_array($table, $public):
				$items->get($table, $param);
				break;
				
		//	Gods and admin see everything
			case $this->user->is_a('admin'):
			case $this->user->is_a('adminfront'):
			//	God view!!!
				if (isset($GLOBALS['map']) && $GLOBALS['map']->is_godView()) unset($param['map']);
			//	Fetch
				$items->get($table, $param);
				break;
			
		//	Normal users only see publics and their privates
			case $this->user->is_a('normal'):
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
 * Get the list of accessible casts
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

/**
 * Get the list of accessible maps
 *
 * @access	public
 */
	public function get_maps()
	{	
	//	Gather the maps of all my companies
		$companies = $this->user['company']->unfold();
		$i = array();
		foreach ($companies as $company)
		{
			foreach ($company['map']->get() as $id) $i[] = str_replace('map_', '', $id);
		}

	//	Fetch the maps
		if (!empty($i))
		{
			return i('map', array(
				'id' => $i,
				'order()' => 'updated DESC',
				'status' => 'live',
			));
		}
		else return new bunch();
	}

/**
 * Get the list of accessible humans
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get_humans($paramHuman = array(), $paramCompany = array())
	{
	//	Some vars
		$humans = new bunch();
	
	//	Fetch companies
		$companies = i('company', $paramCompany);
	
	//	Fetch authors
		foreach ($companies as $company)
		{
		//	Merge param for humans
			$paramHuman['company'] = $company['id']->get();
		//	Fetch humans
			$humans->get('human', $paramHuman);
		}
		return $humans;
	}

/**
 * Get the list of accessible missions
 *
 * @param	string  la table des objets pour la recherche
 * @param	array  	le tableau de paramètres de la recherche
 * @param	string  admin ou site
 * @access	public
 */
	public function get_missions($param = array())
	{
		return $this->get('mission', $param);
	}
}
?>