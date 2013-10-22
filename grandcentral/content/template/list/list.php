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
	$_APP->bind_script('list/js/list.js');
	$_APP->bind_script('list/js/infinitescroll.plugin.js');
	$_APP->bind_css('list/css/list.css');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Amount of items to be displayed at one time
	$limit = 50;
//	Object
	$handled_item = (isset($_GET['item'])) ? $_GET['item'] : trigger_error('You should have an Item by now', E_USER_WARNING);

	$_APP->bind_code('script', '
	<script type="text/javascript" charset="utf-8">
		$(".infiniteScroll").infinitescroll(
		{
			param:
			{
				app:"content",
				template:"list/list.lines",
				param:"'.addslashes(json_encode($_PARAM)).'",
				limit:'.$limit.',
			}
		});
	</script>');
?>