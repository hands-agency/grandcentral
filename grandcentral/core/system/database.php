<?php
/**
 * Database ressources.
 * This class is a singleton. You need database::connect() to instantiate.
 *
 * <pre>
 * // Connect to site database
 * $db = database::connect('site');
 * // Get the page with key = "home"
 * $param = array('key' => 'home');
 * $home = $db->query('SELECT * FROM page WHERE `key` = :key', $param);
 * </pre>
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class database
{
	const charset = 'utf8';
	const collation = 'utf8_unicode_ci';

	private static $instance = array();
	private static $env;
	private static $query_count = 0;
	private static $transactions;

	private $_pdo;
	public $_spooler = array();

/**
 * instantiate PDO and open database connection. Can't be called.
 *
 * @param	string  database type
 * @param	string  database host
 * @param	string  database name
 * @param	string  database user
 * @param	string  database password
 * @access	private
 */
	private function __construct($db_type, $db_host, $db_name, $db_user, $db_password)
	{
		try
		{
		//	récupération du data source name
			$db_dsn = 'mysql:host='.$db_host.';dbname='.$db_name;
		//	connexion
    		$this->_pdo = new PDO($db_dsn, $db_user, $db_password);
		//	pour que les erreurs généréer soient des exceptions
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//	configuration de la connexion
			$this->_pdo->query('SET NAMES '.self::charset);
			$this->_pdo->query('SET @@collation_connection = '.self::collation);
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
 * instantiate a database
 * <pre>
 * $db = database::connect('site');
 * $db->query('SELECT * FROM page');
 * </pre>
 * @param	string	environnement
 * @return	object	database object
 * @access	public
 * @static
 */
	public static function connect($env = env)
	{
		self::$env = (in_array($env, array('site', 'admin'))) ? $env : trigger_error('Environment should be <strong>admin</strong> or <strong>site</strong>.Not '.$env.'.', E_USER_ERROR);
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
 * Get database data source name (DSN)
 *
 * @param	string	database type
 * @param	string	database host
 * @param	string	database name
 * @return	string	dsn formated string
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
 * Query the database
 * To protect your code against SQL injection, you have to use prepared queries
 * See the PHP documentation : http://php.net/manual/fr/pdo.prepare.php
 *
 * <pre>
 * $db = database::connect('site');
 * $db->query('SELECT * FROM page');
 * $db->query('SELECT * FROM page WHERE `key` = :key', array(
 * 	'key' => 'home'
 * 	));
 * </pre>
 * @param	string  SQL query or prepared query
 * @param	array 	array of parameters
 * @return	array	array of results
 * @access	public
 */
	public function query($query, $p = null)
	{
		// print'<pre>';print_r($query);print'</pre>';
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
			// if(SITE_DEBUG) $return['debug'] = debug_backtrace();
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
			}
		//	commit
			$this->_pdo->commit();
		//	free memory
			unset($stmt);
		//	complements
			$return['time'] = microtime(true) - $time_start;
			// self::$queries[] = $return;
			self::$query_count++;
			self::$transactions[] = $return;
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
				'Params' => print_r($p, true)
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
 * Get all the tables from the database
 *
 * @param	string	environnement
 * @return	array	an array of tables name
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
 * Return active bdd name
 *
 * @param	string	environnement
 * @return	string	active database's name
 * @access	public
 * @static
 */
	public function get_name()
	{
		$prefix = strtoupper(self::$env);
		return constant($prefix.'_DB_NAME');
	}

/**
 * Query database for items data
 *
 * @param	string	environnement
 * @param	string	database table
 * @param	array	query parameters
 * @param	bool	active count mode
 * @return	array	query results
 * @access	public
 * @static
 */
	public static function query_item($env, $table, $params = null, $counter = false)
	{
	//	paramètres par défaut
		// if (is_null($params) || (is_array($params) && !array_key_exists('live', $params))) $params['live'] = true;
		if (is_null($params) || (is_array($params) && !array_key_exists('status', $params))) $params['status'] = 'live';
	//	préparation des variables
		$i = 0;
		$cWhere = null;
		$cOrder = null;
		$cLimit = null;
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
	//	recherche de la définition des attributs dans le registre
		// print'<pre>';print_r($params);print'</pre>';
		$attrs = registry::get($env, registry::attr_index, $table, 'attr');
		if (empty($attrs)) trigger_error('Sorry, can\'t find the structure of <strong>'.$table.'</strong>.', E_USER_ERROR);
		$attrsKey = array_keys($attrs);
		$rels = array();
	//	version
		if (isset($attrs['version']) && !isset($params['version']))
		{
			// $params['version'] = i($env, current)['version']->get();
		}
		// print'<pre>';print_r($attrs);print'</pre>';
	//	tri attributs / relations
		foreach ((array) $params as $key => $value)
		{
		//	tri sur les rels
			if (isset($attrs[$key]) && $attrs[$key]['type'] == 'rel')
			{
				$rels[$key] = $value;
				unset($params[$key]);
			}
		//	suppression des params inconnus
			elseif (!isset($attrs[$key]))
			{

                unset($params[$key]);
			}
			elseif (is_null($value)) {
				unset($params[$key]);
			}
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
					case in_array($attrs[$key]['type'], array('string', 'date', 'array', 'key', 'updated', 'created', 'i18n', 'url')):
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
		$tableRel = attrRel::table;
		foreach ((array) $rels as $key => $rel)
		{
			$cKey = '`'.$tableRel.'`.`key` = "'.$key.'" AND `'.$tableRel.'`.`relid` IN';
			$cIn = null;
			foreach ((array) $rel as $value)
			{
				$cIn .= ':relid'.$i.',';
				$tmp =
				$preparedData['relid'.$i] = (mb_strpos($value, '_') !== false) ? mb_substr($value, mb_strpos($value, '_') + 1) : $value;
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
				return '/\b('.$value.')\b/';
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
	//	requête
		$db = database::connect($env);
		$results = $db->query($preparedQuery, $preparedData);
	//	création du tableau de retour
		$datas = array();
		$ids = array();
	//	si SELECT
		if ($counter === false)
		{
		//	affectation des résultats dans le tableau de retour
			foreach ($results['data'] as $data)
			{
				$ids[] = $data['id'];
				$datas[$data['id']] = $data;
			}
		//	recherche des relations
			$is_rel = false;
			foreach ($attrs as $attr)
			{
				if ('rel' == $attr['type'])
				{
					$is_rel = true;
					break;
				}
			}
			if (count($ids) > 0 && $is_rel)
			{
				$relationQuery = 'SELECT * FROM `'.attrRel::table.'` WHERE `item` = "'.$table.'" AND `itemid` IN ('.implode(',', $ids).') ORDER BY position';
				$results = $db->query($relationQuery);
			//	affectation des résultats
				foreach ($results['data'] as $rel)
				{
					$datas[$rel['itemid']][$rel['key']][] = $rel['rel'].'_'.$rel['relid'];
				}
			}
		}
	//	si SELECT COUNT
		else
		{
			$datas['count'] = (empty($cGroupby)) ? $results['data'][0]['count'] : count($results['data']);
		}
		return array_values($datas);
	}

/**
 * Stack queries in a static pile before execution.
 * With database::stack() you can execute multiple queries in a single transaction.
 *
 * @param	string  SQL query or prepared query
 * @param	array 	array of parameters
 * @param	bool 	search for [lastid] in the query string and change it for the last inserted id
 * @access	public
 * @static
 */
	public function stack($query, $params = null, $lastid = false)
	{
		$query = array(
			'query' => $query,
			'params' => $params,
		);
		if ($lastid)
		{
			$query['lastid'] = true;
		}
		$this->_spooler[] = $query;
	}

/**
 * Execute a pile of queries
 *
 * @access	public
 * @static
 */
	public function flush_querystack()
	{
		try
		{
		//	begin transaction
			$this->_pdo->beginTransaction();
		//	Préparation
			for ($i=0, $count=count($this->_spooler); $i < $count; $i++)
			{
			//	prepare query
				$stmt = $this->_pdo->prepare($this->_spooler[$i]['query']);
			//	inject data et execute query
				$stmt->execute($this->_spooler[$i]['params']);
			//	last inserted id
				if (isset($this->_spooler[$i]['lastid']) && $this->_spooler[$i]['lastid'] === true)
				{
					$id = $this->_pdo->lastInsertId();
					// print'<pre>';print_r($id);print'</pre>';
					if (isset($this->_spooler[$i+1]))
					{
						foreach ($this->_spooler[$i+1]['params'] as $key => $value)
						{
							if ($value === 'lastid')
							{
								$this->_spooler[$i+1]['params'][$key] = $id;
							}
						}
					}
				}
			}
		//	commit
			$this->_pdo->commit();
		//	free memory
			unset($stmt);
		//	log
			self::$query_count += count($this->_spooler);
			self::$transactions[] = $this->_spooler;
			$this->_spooler = null;
		//	return
			if (isset($id)) return $id;
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
	    		'What went wrong ?' => 'Sorry, <strong>'.print_r($this->_spooler, true).'</strong> is not a valid transaction.',
		    );
		   	sentinel::log(E_ERROR, $l);
		}
	}
}
?>
