<?php
/**
 * La classe de documentation automatique
 *
 * @package  doc
 * @author	Sylvain Frigui <sf@cafecentral.fr>
 * @link		http://grandcentral.fr
 */

/**
 * Lorem
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	function docAppUrl($app)
	{
		return i('page', current)['url'].'/'.$app;
	}
	
/**
 * Lorem
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	function docClassUrl($app, $class)
	{
		return i('page', current)['url'].'/'.$app.'/'.$class;
	}
	
/**
 * Lorem
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	function docMethodUrl($app, $class, $method)
	{
		return i('page', current)['url'].'/'.$app.'/'.$method;
	}

/**
 * Lorem
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	function docFileUrl($file)
	{
		return 'https://github.com/cafecentral/grandcentral/blob/master/grandcentral/core/system/'.$file;
	}
	
/**
 * Lorem
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	function docFunctionUrl($app, $function)
	{
		return i('page', current)['url'].'/'.$app.'/'.$function;
	}
?>