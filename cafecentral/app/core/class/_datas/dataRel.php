<?php
/**
 * Manipuler les lignes de la table de relations (_rel)
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class dataRel extends _datas
{
	const table = '_rel';
/**
 * Class constructor. Créer un pointer vers l'environnement demandé et la table "_rel" de la bdd
 *
 * @param	string 	Table de la data visée (non pris en compte, toujours _rel)
 * @param	string  Environnement de la data. "admin" ou "site". Environnement actif par défaut
 * @access	public
 */
	public function __construct($table = null, $env = env)
	{
		$this->_env = $env;
		$this->table = $this->get_table();
	}
/**
 * Obtenir la table de la relation
 *
 * @return	string 	la table de la reltion
 * @access	public
 */
	public function get_table()
	{
		return self::table;
	}
/**
 * Obtenir la définition d'une relation
 * 
 * La définition correspond à un tableau contenant les types de chaque colonne (ex array('id' => 'int', 'key' => 'string'))
 *
 * @access	public
 */
	public function define()
	{
		$define = array(
			'item' => 'string',
			'itemid' => 'int',
			'key' => 'string',
			'rel' => 'string',
			'relid' => 'int',
			'position' => 'int'
		);
		return $define;
	}
/**
 * Expérimental : préparer les clauses INSERT dans la table _rel (requêtes préparées)
 *
 * @return	string	la requête INSERT INTO ... VALUES
 * @access	public
 */
	public function prepare_save()
	{
		$this->prepare_delete();
	//	recherche des attributs
		$attrs = $this->define();
	//	premiers pas vers la requête
		foreach ($attrs as $key => $type)
		{
			$attrClass = 'attr'.ucfirst($type);
			$d[$key.self::$count] = (isset($this->data[$key])) ? $attrClass::set($this->data[$key]) : '';
			$columns[] = '`'.$key.'`';
			$values[] = ':'.$key.self::$count;
		}
	//	mise en tampon de la requête
		$q = 'INSERT INTO `'.$this->get_table().'` ('.implode(',', $columns).') VALUES __values__';
		self::$buffer[$q]['values'][] = '('.implode(',', $values).')';
		self::$buffer[$q]['data'][] = $d;
		self::$count++;
		// 
		// $attrs = $this->define();
		// foreach ($attrs as $key => $type)
		// {
		// 	$columns[] = '`'.$key.'`';
		// }
		// $q = 'INSERT INTO `'.self::table.'` ('.implode(',', $columns).') VALUES ';
		// return $q;
	}
/**
 * Expérimental : préparer les clauses VALUES des inserts dans la table _rel (requêtes préparées)
 *
 * @param	int		l'id de la value
 * @return	array	un tableau contenant la requête préparée de type (:itemid0, :item0, ...) et le tableau des valeurs
 * @access	public
 */
	public function prepare_delete()
	{
		if (!empty($this->data['itemid']))
		{
			$q = 'DELETE FROM `'.$this->get_table().'` WHERE `item` = "'.$this->data['item'].'" AND `itemid` IN (__values__)';
			self::$buffer[$q]['values'][] = ':itemid'.self::$count;
			self::$buffer[$q]['data'][] = array(
				':itemid'.self::$count => $this->data['itemid']
			);
			self::$count++;
		}
	}

}
?>