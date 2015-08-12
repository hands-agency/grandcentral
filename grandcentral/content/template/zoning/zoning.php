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
	$form = i('form', $formKey, $handled_env);
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