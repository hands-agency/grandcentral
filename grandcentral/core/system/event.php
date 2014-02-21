<?php
/**
 * Event handling class 
 * 
 * Create, delete and activate events on an item or a bunch of items
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class event
{
	public static $events = array();
	
/**
 * Pré-charger la liste des évènements présents dans la bdd (TODO)
 * 
 * @access	public
 */
	public static function prepare()
	{
	//	Get and store the events
		$events = cc('event', all);
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
 * @param	mixed	l'objet cc ou le nom de l'objet sur lequel lier l'événement
 * @param	string	l'action qui déclenchera l'événement
 * @param	mixed	le nom de la fonction, de la méthode ou la fonction entière à exécuter lors du déclenchement de l'événement
 * @param	mixed	l'argument ou les arguments de la fonction qui sera exécutée
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
 * @param	mixed	l'objet cc ou le nom de l'objet sur lequel délier l'événement
 * @param	string	l'action qui déclenchera l'événement
 * @access	public
 */	
	public static function unbind($item, $action)
	{
		$relfection = new ReflectionClass($item);
		unset(self::$events[$relfection->getName()][$action]);
	}

/**
 * Historique des événements
 *
 * @param	mixed 	l'objet cc ou le nom de l'objet sur lequel déclencher l'événement
 * @param	string	l'action a exécuter
 * @access	public
 */
	private static function log($item, $action)
	{
	//	Can't log the log!
		if ($item->get_table() == 'logbook') return false;
	
	//	Otherwise proceed
		$log = cc('logbook', null, $_SESSION['pref']['handled_env']);
		$attr = array(
			'subject' => $_SESSION['user']->get_table(),
			'subjectid' => $_SESSION['user']['id']->get(),
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
 * @param	mixed	l'objet cc ou le nom de l'objet sur lequel déclencher l'événement
 * @param	string	l'action a exécuter
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
				if (isset($callback['function'])) call_user_func_array($callback['function'], (array) $callback['args']);
				else call_user_func_array(array($item, $callback['method']), (array) $callback['args']);
			}
		}
	//	Log the action
		self::log($item, $action);
	}

/**
 * Get the list of events bound to an item
 *
 * @param	mixed	l'objet cc ou le nom de l'objet
 * @access	public
 */
	public static function get($item)
	{
		$relfection = new ReflectionClass($item);
		return self::$events[$relfection->getName()];
	}
}
?>