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
//	Some binds
/********************************************************************************************/
	$_APP->bind_file('css', 'doc/css/doc.css');

/********************************************************************************************/
//	Get the app list
/********************************************************************************************/
	$apps = registry::get(registry::app_index);
	
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