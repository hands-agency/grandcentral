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
	$_APP->bind_script('notes/js/notes.js');
	$_APP->bind_css('notes/css/notes.css');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Default Max notes displayed
	$displayNotes = 10;
//	Minutes before we divide the notes
	$minuteDivider = 5;

//	Comes via Ajax as well
	if (isset($_POST['displayNotes'])) $displayNotes = $_POST['displayNotes'];
	
/********************************************************************************************/
//	note source
/********************************************************************************************/
//	Via ajax
	if (isset($_POST['item']))
	{
		$item = $_POST['item'];
	}
//	Inline in the page
	else if (isset($_GET['id']) && isset($_GET['item']))
	{
		$item = $_GET['item'].'_'.$_GET['id'];
	}

/********************************************************************************************/
//	Get notes
/********************************************************************************************/
	if (isset($item))
	{
		$notes = i('note', array
		(
			'item' => $item,
			'status' => 'live',
			'order()' => 'created DESC',
			'limit()' => $displayNotes,
		), $_SESSION['pref']['handled_env']);
		
	//	Reverse order
		$notes->data = array_reverse($notes->data);

/********************************************************************************************/
//	Get the form
/********************************************************************************************/
		$form = i('form', 'note', 'admin');
		
	//	Start a new note
		$newNote = i('note');
		$newNote['item'] = $item;
		$form->populate_with_item($newNote);
		
	//	Recreate form
	/*	$form['field'] = array(
			'text' => array(
				'key' => 'text',
				'type' => 'textarea',
				'placeholder' => 'Dont forget the place holder',
			),
			'table' => array(
				'key' => 'table',
				'type' => 'hidden',
			),
			'item' => array(
				'key' => 'item',
				'type' => 'hidden',
			),
			'itemid' => array(
				'key' => 'itemid',
				'type' => 'hidden',
			),
			'status'=>array(
				'key' => 'status',
				'type' => 'hidden',
			),
		);
		$form->save();
	*/
	
	//	Pre-set values
	//	$form->set('table', 'value', 'note');
	//	$form->set('item', 'value', $item);
	//	$form->set('itemid', 'value', $id);
	//	$form->set('status', 'value', 'live');

/********************************************************************************************/
//	Event Source
/********************************************************************************************/
		$EventSource = 	i('page', 'api.eventstream')['url']->args(array
		(
			'app' => 'content',
			'template' => 'notes/notestream',
		));
	}
?>