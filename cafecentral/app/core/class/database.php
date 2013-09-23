<?php
/**
 * La classe de ressources de la base de données
 *
 * Créer une connexion à la bdd et exécuter des requêtes préparées
 *
 * ex :
 * <pre>
 * $db = database::connect('site');
 * $param = array('key' => 'home');
 * $home = $db->query('SELECT * FROM page WHERE `key` = :key', $param);
 * </pre>
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class database
{
	private static $instance = array();
	private static $env;
	private $db_types = array(
		'mysql' => 'mysql:host=[db_host];dbname=[db_name]',
	);
	public static $query_count = 0;
	public static $queries;
	public $_pdo;
	const charset = 'utf8';
	const collation = 'utf8_unicode_ci';
	const registry_attr_index = 'attrs';
	const registry_tablelist = 'db_tables';

/**
 * Configure l'objet PDO et crée la connexion à la base de données
 *
 * @param	string  le type de la bdd
 * @param	string  le host de la bdd
 * @param	string  le nom de la bdd
 * @param	string  le user de la bdd
 * @param	string  le password de la bdd
 * @access	private
 */
	private function __construct($db_type, $db_host, $db_name, $db_user, $db_password)
	{
		try
		{
		//	récupération du data source name
			$db_dsn = $this->_get_dsn($db_type, $db_host, $db_name);
		//	connexion
    		$this->_pdo = new PDO($db_dsn, $db_user, $db_password);
		//	pour que les erreurs généréer soient des exceptions
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//	configuration de la connexion
			$this->_pdo->query('SET NAMES '.self::charset);
			$this->_pdo->query('SET @@collation_connection = '.self::collation);
		//	récupération de la description des colonnes de la base de donées
			// $this->_prepare();
			//return $this->_pdo;
		}
	//	si une erreur se produit, on envoie la sentinel
		catch (PDOException $e) {
			$l = array(
				'What went wrong' => 'Can\'t connect to database '.$db_name.': '.$e->getMessage(),
				'function' => __METHOD__
			);
			sentinel::log(E_ERROR, $l);
		}
	}

/**
 * Obtenir une connexion à la base de données
 * 
 * ex : $db = database::connect('site');
 * $db->query('SELECT * FROM page');
 *
 * @param	string	"site" ou "admin". Par défaut, l'environnement en cours
 * @return	database	l'instance site ou admin de database
 * @access	public
 * @static
 */
	public static function connect($env = env)
	{
		self::$env = $env;
	//	à la manière du singleton
		if (empty(self::$instance[self::$env]))
		{
			$prefix = strtoupper(self::$env);
			$db = array(
				'type' => constant($prefix.'_DB_TYPE'),
				'host' => constant($prefix.'_DB_HOST'),
				'name' => constant($prefix.'_DB_NAME'),
				'user' => constant($prefix.'_DB_USER'),
				'password' => constant($prefix.'_DB_PASSWORD'),
			);
			self::$instance[self::$env] = new database($db['type'], $db['host'], $db['name'], $db['user'], $db['password']);
		}
		return self::$instance[self::$env];
	}

/**
 * Définir le Data Source Name pour la connexion à la base de données
 *
 * @param	string	le type de la bdd
 * @param	string	le host de la bdd
 * @param	string	le nom de la bdd
 * @return	string	le dsn
 * @access	private
 */
	private function _get_dsn($db_type, $db_host, $db_name)
	{
		// print '<pre>';print_r(get::$site);print'</pre>';
		if (isset($this->db_types[$db_type]))
		{
			$from = array('[db_host]', '[db_name]');
			$to = array($db_host, $db_name);
			return str_replace($from, $to, $this->db_types[$db_type]);
		}
		else
		{
			$l = array(
	    		'What went wrong ?' => 'Sorry, <strong>'.$db_type.'</strong> is not supported.',
		    );
		   	sentinel::log(E_ERROR, $l);
		}		
	}
/**
 * Faire des requêtes sur la base de données en mode transactionnel
 *
 * @param	string  la requête SQL à exécuter sur la base
 * @param	array 	le tableau de paramètres pour les requêtes préparées
 * @return	array	le résultat de la requête
 * @access	public
 */
	public function query($query, $p = null)
	{
		try
		{
		//	benchmark
			$time_start = microtime(true);
		//	var
			$return = array(
				'base' => self::$env,
				'query' => $query,
				'param' => $p,
				'time' => null,
				'count' => 0,
				'data' => array()
			);
			if(SITE_DEBUG) $return['debug'] = debug_backtrace();
		//	begin transaction
			$this->_pdo->beginTransaction();
		//	Préparation
			$stmt = $this->_pdo->prepare($query);
		//	Exécution de la requête préparée
			if ($stmt->execute($p))
			{
				$return['count'] = $stmt->rowCount();
				if ($return['count'] > 0 && strstr($query, 'SELECT '))
				{
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
					{
						$return['data'][] = $row;
					}
				}
				if (strstr($query, 'INSERT '))
				{
					$return['inserted_id'] = $this->_pdo->lastInsertId();
				}
			}
		//	commit
			$this->_pdo->commit();
		//	free memory
			unset($stmt);
		//	complements
			$return['time'] = microtime(true) - $time_start;
			// self::$queries[] = $return;
			self::$query_count++;
			self::$queries[] = $return;
		//	return results
			return $return;
		}
	//	Errors
		catch(Exception $e)
		{
		//	cancel transaction
			$this->_pdo->rollback();
		//	erreor message
			$l = array(
				'Message' => $e->getMessage(),
				'Database' => self::$env,
				//'Line' => $e->getFile().' '.$e->getLine(),
	    		'What went wrong ?' => 'Sorry, <strong>'.$query.'</strong> is not a valid request.',
		    );
		   	sentinel::log(E_ERROR, $l);
		}
	}
/**
 * Return the total of executed queries on database::query()
 *
 * @return	int		query count
 * @access	public
 * @static
 */
	public static function query_count()
	{
		return self::$query_count;
	}
	
/**
 * Return la liste des tables de la bdd
 *
 * @param	string	l'environnement désiré. "admin" ou "site"
 * @return	array	la liste des tables
 * @access	public
 * @static
 */
	public static function get_tables($env = env)
	{
		if (!$tables = registry::get($env, registry::dbtable_index))
		{
			$q = 'SHOW TABLES';
			$db = self::connect($env);
			$stmt = $db->_pdo->query($q);
			while ($row = $stmt->fetch(PDO::FETCH_NUM))
			{
				$tables[] = $row[0];
			}
			registry::set($env, registry::dbtable_index, $tables);
		}
		
		return $tables;
	}
	
/**
 * Récupére des tableaux de paramètres, construit les requêtes appropriées et retourne des tableaux de datas
 * 
 * Méthode utilisée par les classes bunch, item et count
 *
 * @param	string	la table de la requête
 * @param	array	le tableau de paramètres sur les attributs (facultatif)
 * @param	array	le tableau de paramètres sur les relations (facultatif)
 * @param	bool	retourne un compteur (false par défaut)
 * @return	array	un tableau d'objets dérivées de _datas
 * @access	public
 */
	public function querydata($table, $params = null, $rels = null, $counter = false)
	{
	//	recherche de la définition des attributs de _datas
		$attrs = array();
		$dataClass = 'data'.ucfirst(str_replace('_', '', $table));
		$dataClass = (registry::get(registry::class_index, $dataClass) && in_array('_datas', class_parents($dataClass))) ? $dataClass : 'data';
		$data = new $dataClass($table, self::$env);
		$attrs = $data->define();
	//	préparation des variables
		$i = 0;
		$cWhere = null;
		$cOrder = null;
		$cLimit = null;
		$attrsKey = array_keys($attrs);
		$preparedData = array();
	//	Construction des clauses de la query
		if (isset($params['order()']))
		{
			$order = $params['order()'];
			unset($params['order()']);
		}
		if (isset($params['limit()']))
		{
			$limit = $params['limit()'];
			unset($params['limit()']);
		}
	//	clause Where
		foreach ((array) $params as $key => $param)
		{
			$cOr = null;
			foreach ((array) $param as $value)
			{
			//	opérateur
				switch ($value)
				{
					case false:
						$operator = '=';
						break;
					case mb_strpos($value, '<'):
					case mb_strpos($value, '>'):
					case mb_strpos($value, '!'):
						preg_match('/([<>!=]+)\s*(.*)/', $value, $matches);
						$operator = $matches[1];
						$value = $matches[2];
						break;
					case in_array($attrs[$key], array('string', 'date', 'array')):
						$operator = 'LIKE';
						break;
					default:
						$operator = '=';
						break;
				}
			//	OR or AND
				if (in_array($operator, array('>', '<', '<=', '>=', '!=')))
				{
					$concat = 'AND';
				}
				else
				{
					$concat = 'OR';
				}
			//	clause OR
				$cOr .= '`'.$table.'`.`'.$key.'` '.$operator.' :'.$key.$i.' '.$concat.' ';
				$preparedData[$key.$i] = $value;
				$i++;
			}
			$cWhere .= '('.substr($cOr, 0, -4).') AND ';
		}
		if ($i > 0) $cWhere = ' WHERE '.substr($cWhere, 0, -5);
	//	clause Relations
		$i = 0;
		$cRel = null;
		$cJoin = null;
		$cGroupby = null;
		$tableRel = dataRel::table;
		foreach ((array) $rels as $key => $rel)
		{
			$cKey = '`'.$tableRel.'`.`key` = "'.$key.'" AND `'.$tableRel.'`.`relid` IN';
			$cIn = null;
			foreach ((array) $rel as $value)
			{
				$cIn .= ':relid'.$i.',';
				$preparedData['relid'.$i] = $value;
				$i++;
			}
			$cRel .= '('.$cKey.' ('.substr($cIn, 0, -1).')) OR ';
		}
		if ($i > 0)
		{
			$cJoin = ' JOIN `'.$tableRel.'` ON (`'.$table.'`.`id` = `'.$tableRel.'`.`itemid` AND `'.$tableRel.'`.`item` = "'.$table.'") AND ('.substr($cRel, 0, -4).')';
			$cGroupby = ' GROUP BY `'.$table.'`.`id` HAVING COUNT(`'.$table.'`.`id`) = '.$i.' ';
		}
	//	clause Order By
		if (isset($order))
		{
		//	tableau à traiter
			$orders = preg_split('/[,]\s*/', $order);
		//	inherit
			for ($e=0, $count=count($orders); $e < $count; $e++)
			{
				if (preg_match('/inherit\((.*)\)/', $orders[$e], $matches))
				{
					if (isset($params[$matches[1]]))
					{
						$field = '"'.implode('","', $params[$matches[1]]).'"';
						$orders[$e] = str_replace($matches[0], 'FIELD('.$matches[1].','.$field.')', $orders[$e]);
					}
				}
			}
		//	on traduit proprement
			$func = function($value)
			{
				return '/\b('.$value.')\b/i';
			};
			$orders = preg_replace(array_map($func, $attrsKey),'`'.$table.'`.`$1`', $orders);
		//	écriture de la clause order by
			$cOrder = ' ORDER BY '.implode(', ', $orders).'';
		}
	//	clause Limit
		if (isset($limit))
		{
			$cLimit = ' LIMIT '.$limit;
		}
	//	écriture de la requête
		if ($counter === false)
		{
			$preparedQuery = 'SELECT `'.$table.'`.* FROM `'.$table.'`'.$cJoin.$cWhere.$cGroupby.$cOrder.$cLimit;
		}
		else
		{
			$preparedQuery = 'SELECT COUNT(*) as count FROM `'.$table.'`'.$cJoin.$cWhere.$cGroupby.$cLimit;
		}
		if ($table == 'logbook') {
			# code...
		
	//	print '<pre>';print_r(str_replace(array('WHERE', 'JOIN', 'GROUP', 'ORDER'), array('<br />WHERE', '<br />JOIN', '<br />GROUP', '<br />ORDER'), $preparedQuery));print'</pre>';
	//	print '<pre>';print_r($preparedData);print'</pre>';
		}
		$results = $this->query($preparedQuery, $preparedData);
	//	création du tableau de retour
		$datas = array();
	//	si SELECT
		if ($counter === false)
		{
			foreach ($results['data'] as $value)
			{
			//	typage des données
				foreach ($value as $k => &$v)
				{
					if (empty($attrs[$k])) $attrs[$k] = 'string';
					$attrClass = 'attr'.ucfirst($attrs[$k]);
					$v = $attrClass::get($v);
				}
			//	création de l'objet approprié
				$data = new $dataClass($table, self::$env);
				$data->set_data($value);
				$datas[] = $data;
			}
		}
	//	si SELECT COUNT
		else
		{
			$datas['count'] = (empty($cGroupby)) ? $results['data'][0]['count'] : count($results['data']);
		}
		return $datas;
	}
}
?>