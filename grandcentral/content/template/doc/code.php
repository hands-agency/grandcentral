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
//	Some apps
/********************************************************************************************/
	load('highlightjs');

/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('doc/css/doc.css');
	$_APP->bind_script('doc/js/doc.js');

/********************************************************************************************/
//	Get the app list
/********************************************************************************************/
	$apps = (isset($_PARAM['app'])) ? array(app($_PARAM['app'])) : registry::get(registry::app_index);
	$docPage = i('page', 'doc', 'admin');
	
/********************************************************************************************/
//	Loop throught the apps and build the doc
/********************************************************************************************/
	$i = 0;
	$html = array();
	
	foreach($apps as $app)
	{
	//	Get the ini file
		$ini = $app->get_ini();
		
	//	General intel
		$html[$i] = array(
			'key' => $app->get_key(),
			'title' => $ini['about']['title'],
		);
		$html[$i]['descr'] = (isset($ini['about']['descr'])) ? $ini['about']['descr'] : null;
		
	//	Files
		$files = array('class', 'lib', 'routine');
		foreach($files as $file)
		{
			if (isset($ini['system'][$file]))
			{
				foreach($ini['system'][$file] as $name)
				{
					$name = strtolower(basename($name, '.php'));
					$html[$i][$file][$name] = array();
				//	List the methods of classes
					if ($file == 'class')
					{	
						$doc = new doc($name);
						// sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $doc);
						$html[$i][$file][$name] = $doc->data;
					}
				}
			}
		}
		$i++;
	}
?>