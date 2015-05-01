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
//	Some vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	$handled_env = $_SESSION['pref']['handled_env'];
	$items = i('item', array('order()' => 'title ASC'), 'site');
	$rights = array('insert' => 'add', 'update' => 'edit', 'delete' => 'delete');
//	$workflows = i('workflowstatus', array('order()' => 'title ASC'), 'site');
	$values = $_FIELD->get_value();
	$data = '';
	
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/right.css');
	$_APP->bind_script('js/right.js');
	
/********************************************************************************************/
//	Build the right-level selector
/********************************************************************************************/
	$levels = array(
		array(
			'key' => 'viewer',
			'title' => 'Viewers',
			'descr' => 'They have no access to Grand Central and can do limited things on '.i('site', current)['title'],
		),
		array(
			'key' => 'manager',
			'title' => 'Managers',
			'descr' => 'They can access Grand Central and edit part of the content',
		),
		array(
			'key' => 'admin',
			'title' => 'Admins',
			'descr' => 'They have god-like privileges and can do whatever they please',
		)
	);
	$radioLevel = '';

	foreach ($levels as $level)
	{
		$checked = (!isset($checked) && !isset($values['level']) OR ($values['level'] == $level['key'])) ? 'checked="checked"' : '';
		$radioLevel .= '<li><input type="radio" name="'.$_FIELD->get_name().'[level]" value="'.$level['key'].'" '.$checked.'><div class="title">'.$level['title'].'</div><div class="descr">'.$level['descr'].'</div></li>';
	}

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	foreach ((array) $values['allow'] as $table => $value)
	{
	//	Options for rights
		$liRights = '';
		foreach ($rights as $key => $right)
		{
			$checked = (isset($values['allow'][$table][$key])) ? 'checked="checked"' : '';
			$liRights .= '<li><input type="checkbox" name="'.$_FIELD->get_name().'[allow]['.$table.']['.$key.']" value="1" '.$checked.'>'.$right.'</li>';
		}
	//	Options for items
		$optionItems = '';
		foreach ($items as $item)
		{
			$selected = ($item['key'] == $table) ? 'selected="selected"' : '';
			$optionItems .= '<option value="'.$item['key'].'" '.$selected.'>'.$item['title'].'</option>';
		}

	//	Template
		$data .= '
		<li>
			<button class="delete"></button>
			<span>They can</span>
			<ul>'.$liRights.'</ul>
			<select>'.$optionItems.'</select>
		</li>';
	}
	
/********************************************************************************************/
//	Now we can build the templates used when creating new fields
/********************************************************************************************/
//	Options for rights
	$liRights = '';
	foreach ($rights as $key => $right) $liRights .= '<li><input type="checkbox" name="'.$_FIELD->get_name().'[allow][]['.$key.']" value="1">'.$right.'</li>';
//	Options for items
	$optionItems = '';
	foreach ($items as $item) $optionItems .= '<option value="'.$item['key'].'">'.$item['title'].'</option>';

//	Template
	$template = '
	<li style="display:none;">
		<button class="delete"></button>
		<span>They can</span>
		<ul>'.$liRights.'</ul>
		<select disabled="disabled">'.$optionItems.'</select>
	</li>';
?>