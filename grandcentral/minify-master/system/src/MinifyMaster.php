<?php

class MinifyMaster{

	public function __construct($name = null)
	{
		if(((defined('SITE_MINIFY') && SITE_MINIFY === true) || !defined('SITE_MINIFY'))
			&& (defined('SITE_DEBUG') && SITE_DEBUG === false))
		{
			// $current_page = defined('item') ? i('page', current)['url']->get().i(item, current)['url']->get_current() : i('page', current)['url']->get_current();
			$current_page = defined('item') ? (string) i(item, current)['url'] : (string) i('page', current)['url'];

			$fileName = isset($name) && !empty($name) ? $name : md5($current_page);

			$minifier_css = new MinifyCSS();
			if ($minifier_css->last_modif_folder('css'))
				$minifier_css->minify_resources('css', $minifier_css, $fileName);
			master::clean_bind('css');
			$minifier_js = new MinifyJS();
			if ($minifier_css->last_modif_folder('script'))
				$minifier_js->minify_resources('script', $minifier_js, $fileName);
		  master::clean_bind('script');

			// echo "<pre>";print_r($current_page);echo "</pre>";
			// exit;
	    $app = app('cache');

	    $app->bind_script('mini/'.$fileName.'.js');
    	$app->bind_css('mini/'.$fileName.'.css');
		}
	}
}

?>
