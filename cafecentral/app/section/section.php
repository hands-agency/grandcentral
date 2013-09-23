<?php
/**
 * The section item of Café Central
 * 
 * @package		Section
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class section extends _items
{
/**
 * Construit la liste des custom data de la section
 *
 * http://html5doctor.com/html5-custom-data-attributes/
 *
 * @return 	string	le code html des custom data
 * @access	public
 */
	public function get_customdata()
	{
		foreach ((array) $this['data'] as $key => $value)
		{
			$data[] = 'data-'.$key.'="'.$value.'"';
		}
		return implode(' ', $data);
	}
/**
 * Affiche une section dans sa zone
 *
 * @return	string	le code html de la section
 * @access	public
 */
	public function bind()
	{
		// print '<pre>';print_r($this);print'</pre>';
	//	création de la vue
		$tpl = $this['template'];
		$app = ($tpl['app'] == 'section') ? $this : $tpl['app'];
		$param = (isset($tpl['param'])) ? $tpl['param'] : null;
		$view = new html($app, $tpl['theme'], $tpl['template'], $param);
	//	récupération du html
		$html = $view->__tostring();
	//	encapsulation
		if (true)
		{
			$html = '<section id="section_'.$this['key'].'" class="'.$this['class'].'" '.$this->get_customdata().'>'.$html.'</section>';
		}
	//	affichage de la section
		$view->bind($this['zone'], $html);
		
		return $this;
	}
}
?>