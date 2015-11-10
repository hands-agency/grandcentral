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
			
		//	Legend	
			$p = array(
				'value' => $title,
				'placeholder' => 'Add a legend',
			//	'field' => 'fieldText' /* Ready for fieldI18n */
			);
			$legend = new fieldText($_FIELD->get_name().'['.$count.'][title]', $p);
		
			$data .= '
			<li title="'.$media->get_key().' • '.strtoupper($media->get_extension()).' • '.$media->get_size().'">
				<button class="delete"></button>
				<div class="preview">'.$media->thumbnail(120, null).'</div>
				<div class="title">'.$legend.'</div>
				<input type="hidden" name="'.$_FIELD->get_name().'['.$count.'][url]" value="'.$path.'" />
			</li>';
			$count++;
		}
	}
		
/********************************************************************************************/
//	The list of add buttons
/********************************************************************************************/
	$addbuttons = '<li><button type="button" data-feathericon="&#xe114">Add media</button></li>';
	
/********************************************************************************************/
//	Now we can build the templates used when creating new fields
/********************************************************************************************/
	$p = array(
		'placeholder' => 'Add a legend',
		'disabled' => true,
	//	'field' => 'fieldText' /* Ready for fieldI18n */
	);
	$legend = new fieldText($_FIELD->get_name().'[][title]', $p);
			
	$template = '
	<li style="display:none;">
		<button class="delete"></button>
		<div class="preview"><img src="" /></div>
		<div class="title">'.$legend.'</div>
		<input type="hidden" name="'.$_FIELD->get_name().'[][url]" value="" disabled="disabled" />
	</li>';
?>