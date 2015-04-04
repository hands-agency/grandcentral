<?php
/**
 * App handling
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class app extends _apps
{

/**
 * Creates an new instance of app class
 *
 * @param	string  app name (ex: "content", "form")
 * @param	string	the template key starting from the root af the app (ex: master/default)
 * @param	array 	an array of parameters
 * @param	string  environnement
 * @access	public
 */
	public function __construct($key, $template = 'default', $params = null, $env = env)
	{
		$this->key = (!empty($key)) ? $key : trigger_error('Your <strong>$key param</strong> is empty, app() will not work', E_USER_WARNING);
		$this->template = (mb_strpos($template, '/') === 0) ? $template : '/'.$template;
		$this->env = $env;
		
		$this->system_root = ADMIN_ROOT.'/'.$this->key.'/'.boot::app_system_dir;
		$this->system_url = '/'.boot::admin_dir.'/'.$this->key.'/'.boot::app_system_dir;
		
		$this->template_root['admin'] = ADMIN_ROOT.'/'.$this->key.'/'.boot::app_template_dir;
		$this->template_root['site'] = SITE_ROOT.'/'.$this->key;
		
		$this->template_url['admin'] = '/'.boot::admin_dir.'/'.$this->key.'/'.boot::app_template_dir;
		$this->template_url['site'] = '/'.boot::site_dir.'/'.SITE_KEY.'/'.$this->key;
		
		$this->get_ini();
		$this->set_default_param();
		$this->set_param($params);
	}	
}
?>