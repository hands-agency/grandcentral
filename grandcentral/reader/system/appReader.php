<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
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
	//	Test if we already have a declared item
		if (defined('item') && registry::get(registry::current_index, item))
		{
			//registry::get(registry::reader_index)
			//echo registry::get(registry::current_index, item);
			echo i($this->param['detail']);
			return;
		}
	//	Some vars
		$page = i('page', current);
		$url = ('home' == $page['key']->get()) ? URLR : mb_substr(URLR, mb_strlen($page['url']->get_current()));
	//	Detail of an item
		if (!empty($url))
		{
		//	Look for our item
			$item = i($this->param['item']);
			// $item->get(array('url' => $url));
			$version = i('version',current)['lang']->get();
			$item->get(array(
				'url' => array(
					'%"'.$version.'____'.$url.'"%', // new format
					$url // old format
				),
				'limit()' => 1)
			);
			// echo "<pre>";print_r($item);echo "</pre>";exit;

		//	We have an item
			if ($item->exists())
			{
				define('reader', $this->param['item']);
				define('item', $this->param['item']);
				registry::set(registry::current_index, item, $item);
				$detail = i($this->param['detail']);
			//	Force display on the reader section
			//	$detail['zone'] =
				echo $detail;
			}
		//	404
			else
			{
				if (isset($this->param['404']) && $this->param['404'] == false)
				{
					header('Status: 301 Moved Permanently', false, 301);
					header('Location: '.$page['url']);
				}
				else {
					ob_clean();
					$page = i('page');
					$page->get_by_url('/404');
					registry::set(registry::current_index, 'page', $page);
					echo $page;
				}
				exit;
			}
		}
	//	List of items
		else
		{
			define('reader', $this->param['item']);
			$list = i($this->param['list']);
		//	Force display on the reader section
		//	$list['zone'] = $this['zone'];
			echo $list;
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
