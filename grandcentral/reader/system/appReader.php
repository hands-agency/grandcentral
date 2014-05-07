<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class appReader extends _apps
{
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  admin ou site (environnement courant par défaut)
 * @access	public
 */
	public function prepare()
	{
		$page = cc('page', current);
		$url = ('home' == $page['key']->get()) ? URLR : mb_substr(URLR, mb_strlen($page['url']->get()));
		// detail
		if (!empty($url))
		{
			// recherche de l'item à afficher
			$item = cc($this->param['item']);
			$item->get(array('url' => $url));
			if ($item->exists())
			{
				define('item', $this->param['item']);
				registry::set(registry::current_index, item, $item);
				echo cc($this->param['detail']);
			}
			// 404
			else
			{
				ob_clean();
				$page = cc('page');
				$page->get_by_url('/404');
				registry::set(registry::current_index, 'page', $page);
				echo $page;
				exit;
			}
		}
		// list
		else
		{
			echo cc($this->param['list']);
		}
	}
/**
 * Afficher l'app
 *
 * @return	string	le code html
 * @access	public
 */
	public function __tostring()
	{
	//	chargement des dépendances
		$this->load();
	//	les quelques variables
		$_APP = &$this;
	//	HACK pour test des fichiers d'initialisation des paramtres de l'app
	//	pour exemple voir le fichier launcher de l'app form
		if (method_exists($this, 'prepare'))
		{
			$this->prepare();
		}
	}
}
?>