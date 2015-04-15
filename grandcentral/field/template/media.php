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
	$_APP->bind_css('css/media.css');
	$_APP->bind_script('js/media.js');
	
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
		if ($media->exists())
		{
			$path = mb_substr($media->get_root(), mb_strpos($media->get_root(), '/media/') + 7); /* TODO Make a method out of this*/
			$title = (isset($value['title'])) ? $value['title'] : null;
			$data .= '
			<li title="'.$media->get_key().' • '.strtoupper($media->get_extension()).' • '.$media->get_size().'">
				<button class="delete"></button>
				<a>
					<span class="preview">'.$media->thumbnail(120, null).'</span>
					<span class="title"><input type="text" name="'.$_FIELD->get_name().'['.$count.'][title]" value="'.$title.'" placeholder="Add a legend" /></span>
				</a>
				<input type="hidden" name="'.$_FIELD->get_name().'['.$count.'][url]" value="'.$path.'" />
			</li>';
			$count++;
		}
	}
	
/********************************************************************************************/
//	Now we can build the templates used when creating new fields
/********************************************************************************************/
	$template = '
	<li style="display:none;">
		<button class="delete"></button>
		<a>
			<span class="preview"><img src="" /></span>
			<span class="title"><input type="text" name="'.$_FIELD->get_name().'[][title]" placeholder="Add a legend" disabled="disabled" /></span>
		</a>
		<input type="hidden" name="'.$_FIELD->get_name().'[][url]" value="" disabled="disabled" />
	</li>';
?>