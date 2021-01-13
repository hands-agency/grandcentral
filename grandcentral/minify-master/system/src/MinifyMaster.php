<?php

class MinifyMaster
{

	public function __construct($name = null)
	{
		if(((defined('SITE_MINIFY') && SITE_MINIFY === true) || !defined('SITE_MINIFY')) && (defined('SITE_DEBUG') && SITE_DEBUG === false))
		{
			(!defined('SITE_MINIFY')) ? define('SITE_MINIFY', true) : define('SITE_MINIFY', true);
			$current_page = defined('item') ? (string) i(item, current)['url'] : (string) i('page', current)['url'];
			$fileName = isset($name) && !empty($name) ? $name : md5($current_page);

			$css = new MinifyCSS();
			if ($this->last_modif_folder('css', $fileName)) $this->minify_resources('css', $css, $fileName);
			master::clean_bind('css');

			$minifier_js = new MinifyJS();
			if ($this->last_modif_folder('script', $fileName)) $this->minify_resources('script', $minifier_js, $fileName);
		  master::clean_bind('script');

	    $app = app('cache');
	    $app->bind_script('mini/'.$fileName.'.js');
    	$app->bind_css('mini/'.$fileName.'.css');
		}
	}

	public function last_modif_folder($type, $name)
	{
			$date = 0;

			$resource_array = master::get_zone_data($type)['data'];
			// echo "<pre>";print_r($resource_array);echo "</pre>";
			$cache = $this->return_md5($type, $name);
			$file = file_exists($cache) ? filemtime($cache) : 0;

			// echo "<pre>";print_r($file);echo "</pre>";
			foreach ($resource_array as $resource) {
					if( isset($resource['url']) )
					{
							$date_prov = filemtime($resource['url']);
					}
					if($date_prov > $date)
					{
							$date = $date_prov;
					}
			}

			if($date > $file)
			{
					return true;
			}
			else
			{
					return false;
			}

	}

	public function minify_resources($type, $minifier, $fileName)
	{
			$resource_array = master::get_zone_data($type)['data'];

			// Vérification du chemin
			foreach ($resource_array as $resource)
			{
					if( isset($resource['url']) && isset($resource['app']))
					{
							// Current app
							$minifier->add($resource['url']);
					}
					else
					{
							$minifier->add($resource['data']);
					}
			}

			$cache = $this->return_md5($type, $fileName);
			$minifier->minify($cache);
			master::vide_bind($type);
	}

	public function return_md5($type, $fileName)
	{
			$version = i('version', current)['key'];
			//$current_page = defined('item') ? i('page', current)['url']->get().i(item, current)['url']->get_current() : i('page', current)['url']->get_current();
			$current_page = defined('item') ? (string) i(item, current)['url'] : (string) i('page', current)['url'];

			$this->if_folder_exists($current_page);

			$app = app('cache');
			if( strcmp($type,'script') == 0)
			{
					$cache = $app->get_templateroot('site').'/mini/'.$fileName.'.js';
			}
			else
			{
					$cache = $app->get_templateroot('site').'/mini/'.$fileName.'.'.$type;
			}
			return $cache;
	}

	public function if_folder_exists($page)
	{
			$app = app('cache');
			$links = array(
					$app->get_templateroot('site').'/mini',
			);

			foreach ($links as $link ) {
					if( is_dir( $link ) )
					{
							return true;
					}
					else
					{
							mkdir( $link, '0777');
							return false;
					}
			}
	}
}

?>
