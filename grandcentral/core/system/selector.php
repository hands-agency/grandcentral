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
	function cc($table, $params = null, $env = env)
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
				return item::create($table, $id, $env);
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
		return cc($table, $params, $env);
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
	function cst($const, $label)
	{
		$const = strtoupper($const);
		$return = (defined($const)) ? constant($const) : $label;
		return $return;
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