<?php
/**
 * App handling
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class app extends _apps
{

/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  only site
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