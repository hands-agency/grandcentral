<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
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
		
	//	création de la liste des attributs vide
		$attrs = registry::get($this->get_env(), registry::attr_index, $this->get_table(), 'attr');
		// print'<pre>'.$table.' : ';print_r(registry::get($this->get_env(), registry::attr_index, 'greenbutton'));print'</pre>';
		if (empty($attrs))
		{
			trigger_error('Can not find <strong>'.$this->get_env().'/'.$this->get_table().'</strong> structure', E_USER_ERROR);
		}
		foreach ($attrs as $key => $attr)
		{
			$attrClass = 'attr'.ucfirst($attr['type']);
			$this->data[$key] = new $attrClass(null, $attr);
		}
		foreach ($attrs as $key => $attr)
		{
			$attrClass = 'attr'.ucfirst($attr['type']);
			if (method_exists($attrClass, 'attach'))
			{
				// print'<pre>';print_r($key);print'</pre>';
				$this[$key]->attach($this);
			}
		}
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