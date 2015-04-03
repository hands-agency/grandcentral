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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
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

/********************************************************************************************/		
//	Build the query
/********************************************************************************************/
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
	//	instantiate a new search
		$search = new searchFulltext('full');
		
	//	Custom rules
		$search->url = false;
		$search->notable = array('logbook');
	//	Go index
		$search->save_index();
	
	//	Fetch results
		$results = $search->search($q, $tables, $limit, $param);
	}
?>