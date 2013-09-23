<?php
/**
 * Classe abstraite de gestion des lignes de la bdd
 * 
 * Un objet data (et ses classes héritées) représente une seule ligne de la base de données.
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @link		http://www.cafecentral.fr/fr/wiki
 * @abstract
 */
abstract class _datas
{
	protected $_env;
	public static $buffer;
	protected static $count = 0;
/**
 * Class constructor. Créer un pointer vers l'environnement demandé et une table de la bdd
 *
 * @param	string 	Table de la data visée
 * @param	string  Environnement de la data. "admin" ou "site". Environnement actif par défaut
 * @access	public
 */
	public function __construct($table, $env = env)
	{
		$this->_env = $env;
		$this->_table = $table;
	}
/**
 * Remplir la data
 *
 * @param	array 	Remplir la propriété data avec le tableau passé en paramètre
 * @access	public
 */
	public function set_data($data)
	{
		$this->data = $data;
		return $this;
	}
/**
 * Obtenir la table de la data
 *
 * @return	string 	la table de la data
 * @access	public
 */
	public function get_table()
	{
		return $this->_table;
	}
/**
 * Obtenir l'environnement de la data
 *
 * @return	string 	l'environnement de la data
 * @access	public
 */
	public function get_env()
	{
		return $this->_env;
	}
/**
 * Retourne la définition des colonnes de la data (informations extraites de la structure de la table)
 *
 * @return	array 	le tableau associatif de définition des colonnes
 * @access	public
 * @abstract
 */
	abstract public function define();
	
	// abstract public function save();
	
	// abstract public function delete();
}
?>