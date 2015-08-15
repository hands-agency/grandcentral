<?php
/**
 * Miranda
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class appConcourse extends _apps
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
	//	Some vars
		$page = i('page', current);
		$url = ('home' == $page['key']->get()) ? URLR : mb_substr(URLR, mb_strlen($page['url']->get()));


		
			
	//	Detail of an item
		if (!empty($url))
		{
		}
	//	List of items
		else
		{
		
		}
	}
}
?>