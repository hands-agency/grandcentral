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
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('doc/css/doc.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$html = null;

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
				$classes = (isset($ini['system']['class'])) ? $ini['system']['class'] : array();
				$libs = (isset($ini['system']['lib'])) ? $ini['system']['lib'] : array();
			//	Loop the doc
				foreach($classes as $class)
				{
				//	Get the class name
					$name = basename($class, '.php');
				//	Produce the doc
					$params['doc'] = new doc($name);
					$html = app('doc', 'class', $params);
				}
				
				break;
		//	Classes & functions
			case 'class':
				$params['doc'] = new doc($name);
				$html = app('doc', 'class', $params);
				break;
			case 'function':
				$params['doc'] = new doc($name);
				$html = app('doc', 'function', $params);
				break;
		//	Methods
			case 'method':
				$params['doc'] = new doc($name);
				$html = app('doc', 'method', $params);
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