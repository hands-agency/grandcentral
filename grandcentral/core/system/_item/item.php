<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class item extends _items
{
/** 
 * Constructor class
 * 
 * Créer un objet et le charge si les paramètres sont disponibles
 * 
 * ex :
 * $page = new item('page', 'home', 'site');
 * 
 * @param	string  la table de l'objet
 * @param	mixed   une id, une clé ou un tableau de paramètres
 * @param	string  "admin" ou "site". Par défaut, l'environnement en cours.
 * @access	public
 */
	public function __construct($table, $env = env)
	{
		$this->table = $table;
		$this->env = $env;
	}
/** 
 * Item factory
 * 
 * Créer un objet et le charge si les paramètres sont disponibles
 * 
 * ex :
 * $page = item::create('page', 'home', 'site');
 * 
 * @param	string  la table de l'objet
 * @param	mixed   une id, une clé ou un tableau de paramètres
 * @param	string  "admin" ou "site". Par défaut, l'environnement en cours.
 * @access	public
 */
	public static function create($table, $params = null, $env = env)
	{
	//	si la classe est un dérivé d'_items, on crée un objet spécifique
		$itemClass = 'item'.ucfirst($table);
		if (registry::get(registry::class_index, $itemClass) === false)
		{
			$item = new item($table, $env);
		}
	//	sinon on crée un item générique
		else
		{
			$item = new $itemClass($env);
		}
	//	query
		if (!is_null($params))
		{
			$item->get($params);
		}
	//	retour
		return $item;
	}
}
?>