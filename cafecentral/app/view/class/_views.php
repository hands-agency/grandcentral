<?php
/**
 * La classe abstraite de manipulation des vues de Café Central
 *
 * la vue permet l'inclusion de fichier de template et l'affichage des données.
 * Un fichier de template est défini par : son app, son thème et une clé de template
 * par exemple pour afficher une page avec le gabarit master :
 * $page = new page('home');
 * $view = new html($page, 'default', 'master');
 * echo $view;
 * 
 * La vue ira alors chercher le fichier /page/default/master.html.php
 *
 * @package  views
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @see      http://www.cafecentral.fr/fr/wiki
 * @abstract
 */
abstract class _views
{
	protected $key;
	protected $app;
	protected $class;
	protected $item;
	protected $routine;
	protected $view;
	protected $root;
	protected $relative_root;
	
	protected $theme_key = 'default';
	protected $theme_root = THEME_ROOT;
	
	protected $template_key;
	protected $template_root;
/**
 * Créer une nouvelle vue
 *
 * @param	mixed	l'objet ou le nom de l'app 
 * @param	string	le thème ("default" par défaut)
 * @param	string  la clé du template
 * @access	public
 */
	public function __construct($item, $theme = null, $template_key = null, $param = null)
	{
		$apps = registry::get('admin', registry::app_index);
		$apps->set_index('key');
		// print '<pre>';print_r($item);print'</pre>';
		if (is_string($item) && isset($apps['app_'.$item])) $item = $apps['app_'.$item];
		if (!is_object($item)) $this->_error('no-app', $item);
		$this->class = get_class($item);
		// print '<pre>';print_r($item);print'</pre>';
		if ($this->class == 'app')
		{
			$this->app = $item;
			$this->item = $item;
			// $this->item->template_key = $this->app->template_key;
			// $this->item->template_root = $this->app->template_root;
		}
		else
		{
			// $this->app = registry::get(registry::app_index, 'app_'.registry::get(registry::class_index, $this->class));
			$this->app = $apps['app_'.registry::get(registry::class_index, $this->class)];
			$this->item = $item;
		}
		if ($theme !== null) $this->set_theme($theme);
		if ($template_key !== null) $this->item->template_key = $template_key;

		if (empty($this->app))
		{
			trigger_error('Je n\'ai pas trouvé l\'app correspondante à la classe <strong>'.$this->class.'</strong>', E_USER_WARNING);
			$this->app = registry::get('admin', registry::app_index, 'core');
		}
		
	//	paramètres
		if (!empty($param)) $this->param = $param;
	}

/**
 * Préparer toutes les propriétés de la vue
 *
 * @access	protected
 */
	protected function _prepare()
	{
		$theme_root = $this->theme_root.'/'.$this->app->get_key();
		if (!is_dir($theme_root))
		{
			$this->_error('no-theme');
			return false;
		}
	//	construction des chemins...
		$this->root = $theme_root.'/'.$this->theme_key;
		if (!is_dir($this->root))
		{
			$this->_error('no-themekey');
			return false;
		}
		$this->template_key = (isset($this->item->template_key)) ? $this->item->template_key : $this->class;
		$this->template_root = (isset($this->item->template_root)) ? $this->item->template_root : null;
		if (isset($this->item->template_root)) $this->root .= $this->item->template_root;
		if (!is_dir($this->root))
		{
			$this->_error('no-root');
			return false;
		}
	//	...vers les fichiers de la vue
		$this->view = $this->root.'/'.$this->template_key.'.'.$this->key.'.php';
		$this->routine = $this->root.'/'.$this->template_key.'.php';
		$this->relative_root = THEME_RELATIVE_ROOT.'/'.$this->app->get_key().'/'.$this->theme_key.$this->template_root;
	//	failsafe pour les objets
		if (!is_file($this->view) && is_subclass_of($this->class, 'items'))
		{
			$this->view = ADMIN_THEME_ROOT.'/core/default/item.html.php';
		}
		// print '<pre>key : ';print_r($this->key);print'</pre>';
		// print '<pre>routine : ';print_r($this->routine);print'</pre>';
		// print '<pre>view : ';print_r($this->view);print'</pre>';
		// print '<pre>root : ';print_r($this->root);print'</pre>';
		// print '<pre>relative_root : ';print_r($this->relative_root);print'</pre>';
		// print '<pre>theme_key : ';print_r($this->theme_key);print'</pre>';
		// print '<pre>theme_root : ';print_r($this->theme_root);print'</pre>';
		// print '<pre>template_key : ';print_r($this->template_key);print'</pre>';
		// print '<pre>template_root : ';print_r($this->template_root);print'</pre>';
	}
	
/**
 * Changer le thème de la vue
 *
 * @param	string  le nom du thème
 * @access	public
 */
	public function set_theme($theme_key)
	{
		$this->theme_root = (env == 'admin') ? ADMIN_THEME_ROOT : THEME_ROOT;
		$this->theme_key = $theme_key;
	}
/**
 * Obtenir le code  html de la vue
 *
 * @return	string	le code html
 * @access	public
 */
	public function __tostring()
	{
	//	on prépare la vue
		$this->_prepare();
	//	on met tout dans le tampon
		$this->_bufferize();
		$content = $this->content;
		unset($this->content);
	//	on affiche
		return $content;
	}
/**
 * Moteur d'inclusion, prépare le tampon de sortie
 *
 * @access	protected
 */
	protected function _bufferize()
	{
	//	on offre quelques variables pour travailler
		$_VIEW = &$this;
		$_APP = &$this->app;
		$_ITEM = &$this->item;
		$_PARAM = &$this->param;
		// print '<pre>';print_r(get_class($this->item));print'</pre>';
		$class = get_class($this->item);
		if (!in_array($class, array('app', 'item')))
		{
			$var = '_'.strtoupper($class);
			$$var = &$this->item;
		}
		$_ROOT = $this->get_root();
	//	on met tout dans le tampon
		ob_start();
		if (is_file($this->routine)) include($this->routine);
		(is_file($this->view)) ? require($this->view) : $this->_error('no-tpl');
		$this->content = ob_get_contents();
		ob_end_clean();
	}
/**
 * Obtenir le répertoire root de la vue en absolue ou relatif
 *
 * @param	bool	true pour le chemin en absolue, false sinon
 * @return	string	le chemin de la vue
 * @access	public
 */
	public function get_root($absolute = false)
	{
		return ($absolute === true) ? $this->root : $this->relative_root;
	}
/**
 * Gestion des erreurs, envoie une sentinelle (à réviser)
 *
 * @param	string  la clé de l'erreur
 * @param	mixed	la valeur responsable de l'erreur
 * @access	protected
 */
	protected function _error($type, $value = null)
	{
		// print '<pre>';print_r($type);print'</pre>';
		if (is_array($value)) $param = $value;
		$error = E_WARNING;
		$param['function'] = 'error::'.get_called_class();
		if (!is_array($value))
		{
		
			switch ($type)
			{
				case 'no-app':
					$param['What went wrong ?'] = 'Sorry, can\'t find app, <strong>'.$value.'</strong>.';
					$error = E_ERROR;
					break;
				case 'no-theme':
					$param['What went wrong ?'] = 'Sorry, can\'t find theme directory <strong>'.$this->theme_root.'</strong>.';
					break;
				case 'no-themekey':
					$param['What went wrong ?'] = 'Sorry, can\'t find theme name <strong>'.$this->theme_key.'</strong>.';
					break;
				case 'no-root':
					$param['What went wrong ?'] = 'Sorry, can\'t find the template root <strong>'.$this->template_root.'</strong>.';
					break;
				case 'no-tpl':
					$param['What went wrong ?'] = 'Sorry, can\'t find the template file <strong>'.$this->view.'</strong>.';
					break;
				case 'no-create':
					$param['What went wrong ?'] = 'Sorry, theme <strong>'.$value.'</strong> already exists.';
					break;
			}
		}
		sentinel::log($error, $param);
	}
}
?>