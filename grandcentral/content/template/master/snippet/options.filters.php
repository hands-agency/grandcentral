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
//	Bind
/********************************************************************************************/
//	$_APP->bind_file('script', 'master/js/options.filters.js');
//	$_APP->bind_file('css', 'master/css/options.filters.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$handled_env = $_SESSION['pref']['handled_env'];
	$handled_item = $_GET['item'];
	$sectiontype = $_POST['sectiontype'];
	
/********************************************************************************************/
//	Switch according to section type
/********************************************************************************************/

//	Propose filters
	$filter = array();
	switch ($sectiontype)
	{
	//	List
		case '/list/list':
		//	Display
			$filter['display'] = array('instack', 'inmasonry');
		//	Order
			$filter['order'] = registry::get($handled_env, registry::attr_index, $handled_item, 'attr');
		//	Sort
			$filter['sort'] = array('asc', 'desc');
			break;
		
	//	Form
		case '/edit/edit':
		//	Importance
			$filter['required'] = array('compulsory', 'optional');
			break;
			
	//	Notes
		case '/notes':
		//	Labels
			$filter['label'] = array('note' , 'bug', 'enhancement', 'question');
		//	About
			$filter['about'] = array('cosmetic', 'seo', 'xplat', 'devfeat', 'item', 'content', 'layout', 'performance');
		//	Visibility
			$filter['visibility'] = array('me', 'groups');
		//	Severity
			$filter['severity'] = array('trivial', 'minor', 'normal', 'major', 'critical', 'blocker');
			/*
				array(
					'key' => 'trivial',
					'descr' => 'Minor glitches in images, not so obvious spell mistakes, etc',
				),
				array(
					'key' => 'minor',
					'key' => 'Secondary feature has a cosmetic issue. Minor feature is difficult to use or looks bad.',
				),
				array(
					'key' => 'normal',
					'descr' => 'Secondary feature is difficult to use or looks terrible. Minor feature does not work, cannot be used, or returns incorrect results',
				),
				array(
					'key' => 'major',
					'descr' => 'Key feature is difficult to use or looks terrible. A secondary feature does not work, cannot be used, or returns incorrect results',
				),
				array(
					'key' => 'critical',
					'descr' => 'Key feature does not work, cannot be used, or returns incorrect results.',
				),
				array(
					'key' => 'blocker',
					'descr' => 'Application or major section freezes, crashes, or fails to start. Data is corrupted.',
				),
				*/
			break;
	}
?>