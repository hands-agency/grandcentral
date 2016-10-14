<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class appCapeb extends _apps
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
		// echo "<pre>";print_r(URLR);echo "</pre>";
		$home = i('page',current);
		$hash = mb_substr(URLR, mb_strlen($home['url']->get_current()));

		$currentPage = i('page');
		$currentPage->get_by_url($hash);
		// echo "<pre>";print_r($currentPage);echo "</pre>";
		if ($currentPage->exists())
		{
			echo $currentPage['section']->unfold();
		}
		else
		{
			ob_clean();
			$page = i('page','error_404');
			registry::set(registry::current_index, 'page', $page);
			echo $page;
		}
		// echo "<pre>";print_r($hash);echo "</pre>";
	}
/**
 * Afficher l'app
 *
 * @return	string	le code html
 * @access	public
 */
	// public function __tostring()
	// {
	//
	// }
}
?>
