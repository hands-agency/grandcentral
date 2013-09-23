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
	$_VIEW->bind('css', '/css/doc.css');

/********************************************************************************************/
//	Get the app list
/********************************************************************************************/
	$param = array();
//	Refine ?
	if (isset($_POST['q'])) $param['title'] = '%'.$_POST['q'].'%';
	$apps = cc('app', $param);
	
/********************************************************************************************/
//	Loop throught the apps and build the doc
/********************************************************************************************/
	$i = 0;
	$html = array();
	
	foreach($apps as $app)
	{
	//	Get the ini file
		$ini = $app->ini();
		
	//	General intel
		$html[$i] = array(
			'title' => $ini['about']['title'],
			'descr' => $ini['about']['descr'],
		);
		
	//	Files
		$files = array('class', 'lib', 'routine');
		foreach($files as $file)
		{
			if (isset($ini['php'][$file]))
			{
				foreach($ini['php'][$file] as $name)
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