<?php
/**
 * The abstract class for app handling.
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class appRss extends _apps
{
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	string	the template key starting from the root af the app (ex: master/default)
 * @param	array 	an array of parameters
 * @param	string  environnement
 * @access	public
 */
	public function __tostring()
	{
		// header('Content-Type: application/rss+xml; charset='.database::charset);
		$this->param = $this->param['page']['type']['master']['param'];
		$content = parent::__tostring();
		return $content;
	}
}
?>