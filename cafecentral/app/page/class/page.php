<?php
/**
 * The page item of Café Central
 * 
 * @package		Page
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class page extends _items
{
/**
 * Détermine en fonction du contexte quelle page afficher
 *
 * @access	public
 */
	public function guess()
	{
	//	recherche par urlr
		// sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, URLR);
		$url = (URLR == '') ? '/' : URLR;
		$this->get(array('url' => $url));
		if (!$this->exists())
		{
			$this->get('error_404');
		}
	}
	
/**
 * Envoie les entêtes HTTP de la page
 *
 * @access	public
 */
	protected function header()
	{
		$template = $this['template'];
		$view = $template['type'];
		$content_type = $view::content_type;
		
		header('HTTP/1.0 '.$this['http_status']);
		header('Content-Type: '.$content_type.'; charset=utf-8');
	}
	
/**
 * Affiche dans leur zone toutes les sections associées à la page
 *
 * @access	public
 */
	public function bind_section()
	{
		$sections = $this->get_rel('section');
		// print '<pre>';print_r($sections);print'</pre>';
		// $view = new html('section');
		if ($sections->count() != 0)
		{
			foreach ($sections as $section)
			{
				// $view->bind($section['zone'], $section);
				$section->bind();
			}
		}
		
		return $this;
	}
	
/**
 * Affiche dans leur zone toutes les sections associées à la page
 *
 * @access	public
 */
	public function __tostring()
	{
		$this->header();
		$template = $this['template'];
		// print '<pre>';print_r($this);print'</pre>';
		$view = new $template['type']($this, $template['theme'], $template['template']);
		return $view->__tostring();
	}
}
?>