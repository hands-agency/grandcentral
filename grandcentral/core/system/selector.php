<?php
/**
 * Selectors Library
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */

/**
 * i() is our Universal Selector and the most useful function around. It lets you fetch, handle and display one or many items from your database:
 * <pre>
 * // Fetch all socks
 * $socks = i('socks', all);
 * </pre>
 * You can fetch an item by id, key or nickname
 * <pre>
 * // Fetch a sock by id
 * $socks = i('socks', 123);
 * // Fetch a sock by key
 * $socks = i('socks', 'polkadot');
 * // Fetch a sock by nickname
 * $socks = i('socks_123');
 * </pre>
 * The Universal Selector takes all the parameters of bunches:
 * <pre>
 * // Fetch a set of socks
 * $socks = i('socks,
 * 	'title' => 'best-offer%',
 * 	'size' => array('XL', 'L'),
 * 	'codes' => array(2, 4),
 * 	'tag' => 1,
 * 	'order()' => 'color DESC, size ASC',
 * 	'limit()' => 10,
 *  'instock' => true,
 * );
 * </pre>
 * You can also fetch the current page:
 * <pre>
 * // Fetch the current page
 * $page = i('page', current);
 * </pre>
 * Or the current item in the script if you have a reader:
 * <pre>
 * // Fetch the current read item
 * $page = i(item, current);
 * </pre>
 *
 * @param	string	table
 * @param	mixed	parameter or array of parameters
 * @param	string	admin ou site
 * @return	mixed	an item or a bunch
 * @access	public
 */
	function i($table, $params = null, $env = 'site')
	{
		switch (true)
		{
		//	bunch de tous les items de la table
			case $params == all:
				// print '<pre>';print_r('all');print'</pre>';
				return new bunch($table, null, $env);
				break;
		//	item de l'environnement
			case $params == current:
				// print '<pre>';print_r('current');print'</pre>';
				return registry::get(current, $table);
				break;
		//	bunch d'items en fonction des paramètres
			case is_array($params):
				// print '<pre>';print_r('bunch');print'</pre>';
				return new bunch($table, $params, $env);
				break;
		//	nickname
			case is_null($params) && mb_strpos($table, '_'):
				list($table, $id) = explode('_', $table);
				// print'<pre>';print_r($table);print'</pre>';
				return item::create($table, array('id' => $id, 'status' => null), $env);
				break;
		//	nouvel item
			case is_null($params):
				// print '<pre>';print_r('new');print'</pre>';
				return item::create($table, null, $env);
				break;
		//	item
			case is_string($params):
			case is_int($params):
				// print '<pre>';print_r('item');print'</pre>';
				return item::create($table, $params, $env);
				break;
		}
	}
/**
 * Old CC selector (for continuity)
 *
 * @param	string	table
 * @param	mixed	parameter or array of parameters
 * @param	string	admin ou site
 * @return	mixed	an item or a bunch
 * @access	public
 */
	function cc($table, $params = null, $env = env)
	{
		return i($table, $params, $env);
	}
/**
 * Euro selector
 *
 * @param	string	table
 * @param	mixed	parameter or array of parameters
 * @param	string	admin ou site
 * @return	mixed	an item or a bunch
 * @access	public
 */
	function €($table, $params = null, $env = env)
	{
		return i($table, $params, $env);
	}
/**
 * Get constant by key
 *
 * @param	string	constant key
 * @param	array	values to replace in the string
 * @return	string	the constant or the key if undefined
 * @access	public
 */
	function cst($key, $data = null)
	{
		// get the constants
		$key = mb_strtoupper($key);
		$const = registry::get(env, 'const', $key);
		$string = (is_a($const, '_attrs')) ? $const->__tostring() : $key;
		// insert the data into the string
		if (!is_null($data) && is_array($data))
		{
			$from = array_map(function($n)
			{
				return '['.$n.']';
			}, array_keys($data));
			$to = array_values($data);
			
			$string = str_replace($from, $to, $string);
		}
		
		return $string;
	}
/**
 * Constant handling
 *
 * @param	string	table
 * @param	mixed	parameter or array of parameters
 * @param	string	admin ou site
 * @return	mixed	an item or a bunch
 * @access	public
 */
	function t($value)
	{
		return itemConst::t($value);
	}
/**
 * load() lets you simply load apps into the system:
 * <pre>
 * // Load jQuery, Sir Trevor and Masonry 
 * load('jquery', 'sirtrevor', 'masonry');
 * </pre>
 *
 * @param	string	app 1
 * @param	string	app 2...
 * @access	public
 */
	function load()
	{
		$apps = func_get_args();
		foreach ($apps as $app)
		{
			$app = app($app);
			$app->load();
			unset($app);
		}
	}
	
/**
 * App factory
 *
 * @param	string	app 1
 * @param	string	app 2...
 * @access	public
 */
	function app($key, $template = 'default', $params = null, $env = env)
	{
		$appClass = 'app'.ucfirst($key);
		if (registry::get(registry::class_index, $appClass) === false)
		{
			$app = new app($key, $template, $params, $env);
		}
		else
		{
			$app = new $appClass($template, $params, $env);
		}
		return $app;
	}
?>