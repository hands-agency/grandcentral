<?php
/**
 * Event handling class 
 * 
 * Create, delete and activate events on an item or a bunch of items
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class event
{
	public static $events = array();
	
/**
 * Get all the events
 * 
 * @access	public
 */
	public static function prepare()
	{
	//	Get and store the events
		$events = i('event', all);
		foreach ($events as $event) self::bind($event['item'], $event['trigger'], $event['function'], $event['arg']);
	}

/**
 * Bind an event to an item
 * 
 * ex :
 * event::bind('page', 'save', function() {echo 'mortaciture <br />';});
 * event::bind('page', 'save', function($oupas) {echo ' tout à fait '.$oupas;}, 'ou pas');
 * event::bind('user', 'save', 'mail', 'create');
 * event::bind('user', 'delete', 'mail', 'delete');
 * event::bind('page', 'save', 'pourquoipas', array('manger', 'des patates'));
 * function pourquoipas($action, $type)
 * {
 * 	echo '<br />pourquoi pas '.$action.' '.$type;
 * }
 *
 * @param	mixed	item object or item name
 * @param	string	name of the action (save, delete...)
 * @param	mixed	function name (string) or method name (array) to call when event is triggered
 * @param	mixed	function arguments
 * @access	public
 */	
	public static function bind($item, $action, $function, $args = null)
	{
		$relfection = new ReflectionClass($item);
		$class = $relfection->getName();
		$index = (is_string($function) && $relfection->hasMethod($function)) ? 'method' : 'function';
		
		if (isset($item->data['id'])) $callback['id'] = $item['id'];
		$callback[$index] = $function;
		$callback['args'] = (empty($args)) ? array() : $args;
		self::$events[$class][$action][] = $callback;
	}

/**
 * Unbind an event
 *
 * @param	mixed	item object or item name
 * @param	string	name of the action (save, delete...)
 * @access	public
 */	
	public static function unbind($item, $action)
	{
		$relfection = new ReflectionClass($item);
		unset(self::$events[$relfection->getName()][$action]);
	}

/**
 * Auto Log
 *
 * @param	mixed 	item object or item name
 * @param	string	name of the action (save, delete...)
 * @access	private
 */
	private static function log($item, $action)
	{
	//	Can't log the log!
		if ($item->get_table() == 'logbook') return false;
	
	//	Otherwise proceed
		$env = is_a($item, '_items') ? $item->get_env() : env;
		$log = i('logbook', null, $env);
		$user = isset($_SESSION) && isset($_SESSION['user']) ? $_SESSION['user'] : i('human');
		
		$attr = array(
			'subject' => $user->get_table(),
			'subjectid' => $user['id']->get(),
			'key' => $action,
			'item' => $item->get_table(),
			'itemid' => $item['id']->get(),
		);
		foreach ($attr as $key => $value) $log[$key] = $value;
		$log->save();
	}

/**
 * Trigger an event
 *
 * @param	mixed	item object or item name
 * @param	string	name of the action (save, delete...)
 * @access	public
 */	
	public static function trigger($item, $action)
	{
		$relfection = new ReflectionClass($item);
		$class = $relfection->getName();
		if (isset(self::$events[$class][$action]))
		{
			foreach ((array) self::$events[$class][$action] as $callback)
			{
			//	Add the item as a first argument
				array_unshift($callback['args'], $item);
			//	???
				if (isset($callback['id']) && isset($item->data['id']) && $callback['id'] != $item->data['id'])	break;
				if (isset($callback['function'])) {call_user_func_array($callback['function'], (array) $callback['args']);}
				else call_user_func_array(array($item, $callback['method']), (array) $callback['args']);
			}
		}
	//	Log the action
		self::log($item, $action);
	}

/**
 * Get the list of events bound to an item
 *
 * @param	mixed	item object or item name
 * @access	public
 */
	public static function get($item)
	{
		$relfection = new ReflectionClass($item);
		return self::$events[$relfection->getName()];
	}
}
?>