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
 * Main selector
 *
 * @param	string	table
 * @param	mixed	parameter or array of parameters
 * @param	string	admin ou site
 * @return	mixed	an item or a bunch
 * @access	public
 */
	function i($table, $params = null, $env = env)
	{
		switch (true)
		{
		//	bunch de tous les items de la table
			case $params == all:
				// print '<pre>';print_r('all');print'</pre>';
				return new bunch($table, array('status' => null), $env);
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
 * Constant handling
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