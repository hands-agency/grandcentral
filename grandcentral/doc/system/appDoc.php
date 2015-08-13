<?php
/**
 * AppDoc
 *
 * @package  Doc
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class appDoc extends _apps
{
	
/**
 * Utilise l'url pour envoyer sur la bonne ressource de la documentation
 *
 * @access	public
 */
	public function prepare()
	{
		if (env == 'site')
		{
		//	Some vars
			$page = i('page', current);
			$url = ('home' == $page['key']->get()) ? URLR : mb_substr(URLR, mb_strlen($page['url']->get()) + 1);
		
		//	Detail of an element of the doc
			if (!empty($url))
			{
				$chunks = explode('/', $url);
				$count = count($chunks);
			
				switch ($count)
				{
					case 1:
						$this->param['app'] = new app($chunks[0]);
						$this->template = '/app/detail';
						break;
					case 2:
						$this->param['app'] = new app($chunks[0]);
						$this->param['doc'] = new doc($chunks[1]);
						$this->template = '/'.$this->param['doc']->get_type().'/detail';
						break;
				
				}
			}
		//	List of apps
			else
			{
				$this->param['app'] = registry::get(registry::app_index);
				$this->template = '/app/list';
			}
		}
	}
}
?>