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
	public function __construct($table, $param = null, $env = env)
	{
		$this->data = new data($table, $env);
		if ($param != null) $this->get($param);
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
	//	on va chercher les structures et les apps dans le registre
		if ($params !== null && !is_array($params) && in_array($table, array('app', 'structure')) && $bunch = registry::get($env, constant('registry::'.$table.'_index')))
		{
			$index = (is_numeric($params)) ? 'id' : 'key';
			$const = $table.'_index';
			$bunch->set_index($index);
			if (isset($bunch[$table.'_'.$params])) return $bunch[$table.'_'.$params];
		}
	//	on charge les classes disponibles
		$ccClasses = registry::get(registry::class_index);
	//	si la classe est un dérivé d'_items, on crée un objet spécifique
		if (in_array($table, array('app', 'structure')) || ($ccClasses !== false && in_array($table, array_keys($ccClasses)) && is_subclass_of($table, '_items')))
		{
			$item = new $table($params, $env);
		}
	//	sinon on crée un item générique
		else
		{
			$item = new item($table, $params, $env);
		}
	//	retour
		return $item;
	}
}
?>