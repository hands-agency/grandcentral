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
	$_APP->bind_file('css', 'doc/css/doc.css');
	
/********************************************************************************************/
//	What to display
/********************************************************************************************/
//	Order matters, it's important that the method be tested first
	$types = array('app', 'method', 'class', 'function');
	foreach($types as $types)
	{
		if (isset($_GET[$types]))
		{
			$type = $types;
			$name = $_GET[$types];
			break;
		}
	}

/********************************************************************************************/
//	Different types of docs
/********************************************************************************************/
	if (isset($type) && isset($name))
	{
		switch ($type)
		{
		//	Apps
			case 'app':
				$app = registry::get(registry::app_index, $name);
				$ini = $app->get_ini();
				if (isset($ini['php']['class'])) $classes = $ini['php']['class'];
				if (isset($ini['php']['lib'])) $libs = $ini['php']['lib'];
			//	Loop the doc
				foreach($classes as $class)
				{
				//	Get the class name
					$name = basename($class, '.php');
				//	Produce the doc
					$params['doc'] = new doc($name);
					$html = new app('doc', 'class', $params);
					
				}
				break;
		//	Classes & functions
			case 'class':
				$params['doc'] = new doc($name);
				$html = new app('doc', 'class', $params);
				break;
			case 'function':
				$params['doc'] = new doc($name);
				$html = new app('doc', 'function', $params);
				break;
		//	Methods
			case 'method':
				$params['doc'] = new doc($name);
				$html = new app('doc', 'method', $params);
				break;
		
		//	Nothing
			default:
				$e = array(
					'What went wrong' => 'no, no, no',
					'Try that' => 'be a better man',
				);
				sentinel::log(E_NOTICE, $e);
				break;
		}
	}
//	No doc
	else $html = '<div class="nodata">Sorry, I have no documentation for this.</div>';
?>