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
//	Vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_file('css', 'css/media.css');
	$_APP->bind_file('script', 'js/media.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	The data from the DB
	$data = '';
//	The html templates for jQuery
	$template = '';
//	A counter
	$count = 0;

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	$values = $_FIELD->get_value();
	
	foreach ((array) $values as $key => $value)
	{
	//	Fetch media
		$media = media($value['url']);
		$path = mb_substr($media->get_root(), mb_strpos($media->get_root(), '/media/') + 7); /* TODO Make a method out of this*/
		$title = (isset($value['title'])) ? $value['title'] : null;
		$data .= '
		<li>
			<button class="delete"></button>
			<a>
				<span class="preview">'.$media->thumbnail(120, null).'</span>
				<span class="title">'.$media->get_key().'</span>
				<span class="info">'.strtoupper($media->get_extension()).' • '.$media->get_size().'</span>
			</a>
			<input type="hidden" name="'.$_FIELD->get_name().'['.$count.'][url]" value="'.$path.'" />
			<input type="hidden" name="'.$_FIELD->get_name().'['.$count.'][title]" value="'.$title.'" />
		</li>';
		$count++;
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
		<input type="hidden" name="'.$_FIELD->get_name().'[][url]" value="" disabled="disabled" />
	</li>';
?>