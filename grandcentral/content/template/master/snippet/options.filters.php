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
			$filter['display'] = array(
				'type' => 'exclusive',
				'data' => array('instack', 'incard'),
			);
		//	Order
			$filter['order'] = array(
				'type' => 'exclusive',
				'data' => registry::get($handled_env, registry::attr_index, $handled_item, 'attr'),
			);
		//	Sort
			$filter['sort'] = array(
				'type' => 'exclusive',
				'data' => array('asc', 'desc'),
			);
			break;
		
	//	Form
		case '/edit/edit':
		//	Importance
			$filter['required'] = array(
				'type' => 'exclusive',
				'data' => array('compulsory', 'optional'),
			);
			break;
			
	//	Notes
		case '/notes':
		//	Labels
			$filter['label'] = array(
				'type' => 'exclusive',
				'data' => array('note' , 'bug', 'enhancement', 'question'),
			);
		//	About
			$filter['about'] = array(
				'type' => 'exclusive',
				'data' => array('cosmetic', 'seo', 'xplat', 'devfeat', 'item', 'content', 'layout', 'performance'),
			);
		//	Visibility
			$filter['visibility'] = array(
				'type' => 'exclusive',
				'data' => array('me', 'groups'),
			);
		//	Severity
			$filter['severity'] = array(
				'type' => 'exclusive',
				'data' => array('trivial', 'minor', 'normal', 'major', 'critical', 'blocker'),
			);
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