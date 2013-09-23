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
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Bind
/********************************************************************************************/
//	$_VIEW->bind('script', '/js/options.filters.js');
//	$_VIEW->bind('css', '/css/options.filters.css');
	
/********************************************************************************************/
//	Switch according to section type
/********************************************************************************************/
	$sectiontype = $_POST['sectiontype'];

//	Propose filters
	$filter = array();
	switch ($sectiontype)
	{
	//	Listing
		case 'listing':
		
		//	Order
			$structure = cc($_GET['item'], null, $_SESSION['pref']['handled_env'])->get_structure();
			$filter['order'] = $structure['attr'];

		//	Author
			$humans = cc('human', all, 'site');
			$filter['author'] = $humans;
			
		//	Display
			$display = array(			
				array(
					'key' => 'instack',
					'title' => 'In stack',
				),
				array(
 					'key' => 'ingrid',
 					'title' => 'In grid',
 				),
				array(
					'key' => 'infamilies',
					'title' => 'In families',
 				),
			);
			$filter['display'] = $display;	
			break;
		
	//	form
		case 'edit':
		
		//	Importance
			$importance = array(			
				array(
					'key' => 'compulsory',
					'title' => 'Compulsory',
				),
				array(
 					'key' => 'importance',
 					'title' => 'Important',
 				),
				array(
					'key' => 'normal',
					'title' => 'Normal',
 				),
			);
			$filter['importance'] = $importance;
			break;
			
	//	Notes
		case 'notes':
		
		//	Labels
			$label = array(			
				array(
					'key' => 'note',
					'title' => 'Note',
				),
				array(
 					'key' => 'bug',
 					'title' => 'Bug',
 				),
				array(
					'key' => 'enhancement',
					'title' => 'Enhancement',
 				),
				array(
					'key' => 'question',
					'title' => 'Question',
 				),
			);
			$filter['label'] = $label;

		//	About
			$about = array(			
				array(
					'key' => 'cosmetic',
					'title' => 'Cosmetic',
				),
				array(
 					'key' => 'seo',
 					'title' => 'SEO',
 				),
				array(
					'key' => 'xplat',
					'title' => 'Crossplatforming',
 				),
				array(
					'key' => 'devfeat',
					'title' => 'Development & features',
 				),
				array(
					'key' => 'structure',
					'title' => 'Structure',
 				),
				array(
					'key' => 'content',
					'title' => 'Content',
 				),
				array(
					'key' => 'layout',
					'title' => 'Layout',
 				),
				array(
					'key' => 'performance',
					'title' => 'Performance',
 				),
			);
			$filter['about'] = $about;
			
		
		//	Visibility
			$visibility = array(			
				array(
					'key' => 'me',
					'title' => 'My eyes only',
					'descr' => 'Assigned to me or one of my groups.',
				),
				array(
 					'key' => 'groups',
 					'title' => 'groups..',
 				),
			);
			$filter['visibility'] = $visibility;
			
		//	Severity
			$severity = array(			
				array(
					'key' => 'trivial',
					'title' => 'Trivial',
					'descr' => 'Minor glitches in images, not so obvious spell mistakes, etc',
				),
				array(
					'key' => 'minor',
					'title' => 'Minor',
					'key' => 'Secondary feature has a cosmetic issue. Minor feature is difficult to use or looks bad.',
				),
				array(
					'key' => 'normal',
					'title' => 'Normal',
					'descr' => 'Secondary feature is difficult to use or looks terrible. Minor feature does not work, cannot be used, or returns incorrect results',
				),
				array(
					'key' => 'major',
					'title' => 'Major',
					'descr' => 'Key feature is difficult to use or looks terrible. A secondary feature does not work, cannot be used, or returns incorrect results',
				),
				array(
					'key' => 'critical',
					'title' => 'Critical',
					'descr' => 'Key feature does not work, cannot be used, or returns incorrect results.',
				),
				array(
					'key' => 'blocker',
					'title' => 'Blocker',
					'descr' => 'Application or major section freezes, crashes, or fails to start. Data is corrupted.',
				),
			);
			$filter['severity'] = $severity;
			break;
	}
?>