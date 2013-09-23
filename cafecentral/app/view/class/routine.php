<?php
/**
 * La classe de manipulation des vues routine
 *
 * @package  views
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class routine extends _views
{
	protected $key = 'routine';
	const content_type = 'text/html';
	
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
		$_ROOT = $this->get_root();
	//	on met tout dans le tampon
		ob_start();
		(is_file($this->view)) ? require($this->view) : $this->_error('no-tpl');
		$this->content = ob_get_contents();
		ob_end_clean();
	}
}
?>