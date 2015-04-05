<?php
/**
 * La classe de documentation automatique
 *
 * @package  doc
 * @author	Sylvain Frigui <sf@hands.agency>
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
		return 'http://grandcentral.fr/doc/'.$app;
	}
	
/**
 * Lorem
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	function docClassUrl($app, $class)
	{
		return 'http://grandcentral.fr/doc/'.$app.'/'.$class;
	}
	
/**
 * Lorem
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	function docMethodUrl($app, $class, $method)
	{
		return 'http://grandcentral.fr/doc/'.$app.'/'.$method;
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
		return 'http://grandcentral.fr/doc/'.$app.'/'.$function;
	}
?>