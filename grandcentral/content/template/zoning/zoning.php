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
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/	
	$_APP->bind_css('zoning/css/zoning.css');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/	
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Item
	$handled_item = $_GET['item'];
	$handled_id = (isset($_GET['id'])) ? $_GET['id'] : null;
	$item = i($handled_item, $handled_id);
	
	$formKey = SITE_KEY.'_page_zoning';

/********************************************************************************************/	
//	Create the new form if not already existing
/********************************************************************************************/
	$form = i('form', $formKey);
	if (!$form->exists())
	{
		$form['key'] = $form['title'] = $formKey;
		$form['template'] = 'default';
		$form['action'] = 'post';
		$form['method'] = 'post';
		$form['system'] = true;
		$form['field'] = array
		(
			'id' => array(
				'key' => 'id',
				'type' => 'hidden',
				'readonly' => true,
			),
			'section' => array(
				'key' => 'section',
				'type' => 'zoning',
			),
		);
		$form->save();
	}
	$form->populate_with_item($item);
//	Set action to admin post
	$form->set_action(i('page', 'post', 'admin')['url']);
?>