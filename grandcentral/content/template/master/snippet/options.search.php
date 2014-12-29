<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 * 
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2013, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
//	$_APP->bind_script('master/js/options.filters.js');
//	$_APP->bind_css('master/css/options.filters.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$handled_env = $_SESSION['pref']['handled_env'];

	$q = $_POST['q'];
		
//	Our Query
	if (isset($_POST['search']))
	{
		$tables = array();
		$param = array();
		$limit = 20;
		$nodata = '(Nothing!)';
	}
	else $nodata = '(We have just refined the list below looking for \''.$q.'\'. Hit ↵ to search.)';
	
/********************************************************************************************/
//	Fetch items
/********************************************************************************************/
	if (isset($tables))
	{
	/*
	//	Instanciate a new search
		$search = new searchFulltext();
		
	//	Custom rules
		$search->norel = array('child','section','page');
	//	Go index
		$search->create_table();
		$search->save_index();
	
	//	Fetch results
		$results = $search->search($q, $tables, $limit, $param);
	*/
	//	$results = i('human', all, 'site');
	}
?>