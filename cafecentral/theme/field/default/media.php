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
	$_VIEW->bind('css', '/css/media.css');
	$_VIEW->bind('script', '/js/media.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	The data from the DB
	$data = '';
//	The html templates for jQuery
	$template = '';

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	$values = $_ITEM->get_value();
	foreach ((array) $values as $key => $value)
	{
	//	Fetch media
		$media = new image($value);
		$data .= '
		<li>
			<button class="delete"></button>
			<a>
				<span class="preview"><img src="'.$media->thumbnail(120, null).'" /></span>
				<span class="title">'.$media->get_key().'</span>
				<span class="info">'.strtoupper($media->get_extension()).' • '.$media->get_size().'</span>
			</a>
			<input type="hidden" name="'.$_ITEM->get_name().'[]" value="'.$media->get_url().'" />
		</li>';
	}
	
/********************************************************************************************/
//	Now we can build the templates used when creating new fields
/********************************************************************************************/
	$template = '
	<li style="display:none;">
		<button class="delete"></button>
		<a>
			<span class="preview"><img src="" /></span>
			<span class="title"></span>
			<span class="info"></span>
		</a>
		<input type="hidden" name="'.$_ITEM->get_name().'[]" value="" disabled="disabled" />
	</li>';
?>