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

/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/multipleselect.css');
	$_APP->bind_script('js/multipleselect.plugin.js');
	$_APP->bind_script('js/multipleselect.js');

/********************************************************************************************/
//	The rel
/********************************************************************************************/
	// $attrs = $_FIELD->get_attrs();
	// print '<pre>';print_r($attrs);print'</pre>';

//	Careful with the environement
	$env = (env == 'admin' && !empty($_SESSION['pref']['handled_env'])) ? $_SESSION['pref']['handled_env'] : env;
	$selected = new bunch(null, null, $env);

//	Get the selected value(s)
	$value = $_FIELD->get_value();

	$tmp = array();
	if (!empty($value))
	{
	//	Prepare them to be in a bunch
		foreach ($value as $id)
		{
			list($table, $index) = explode('_', $id);
			$tmp[$table][] = $index;
		}
	//	Go fetch the bunch
		foreach ($tmp as $item => $ids) $selected->get($item, array('id' => $ids, 'order()' => 'inherit(id)', 'status' => array('live', 'asleep')));
	}

//	Show/hide Noda
	if ($selected->count() == 0) $hideNodata = null;
	else $hideNodata = 'style="display:none;"';

//	Get the available values
	// $available = $_FIELD->prepare_values();

/********************************************************************************************/
//	Sort of a repository of data for Ajax
/********************************************************************************************/
	$name = $_FIELD->get_name();
	$values = htmlspecialchars(json_encode($_FIELD->get_values()), ENT_COMPAT | JSON_UNESCAPED_UNICODE);
	$valuestype = $_FIELD->get_valuestype();
?>
