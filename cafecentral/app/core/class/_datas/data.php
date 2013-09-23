<?php
/**
 * Handles data fetched in the database
 *
 * a data = one line in the database
 * 
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class data extends _datas
{
	protected $_table;
	protected static $_inserted_id;
/**
 * Obtenir la définition de la data manipulée.
 * 
 * La définition correspond à un tableau contenant les types de chaque colonne (ex array('id' => 'int', 'key' => 'string'))
 *
 * @access	public
 */
	public function define()
	{
		return ($definition = registry::get($this->_env, registry::attr_index, $this->_table)) ? $definition : $this->_get_definition();
	}
/**
 * Charger dans le registre tous les attributs des tables pour le typage des données
 *
 * @access	private
 */
	private function _get_definition()
	{
	//	on va chercher tous les attributs avec leur table
		$db = database::connect($this->_env);
		$param = array(
			'key' => $this->_table
		);
		$attrs = $db->query('SELECT `attr` FROM `structure` WHERE `key` = :key LIMIT 1', $param);
		if ($attrs['count'] > 0)
		{
			foreach (json_decode($attrs['data'][0]['attr'], true) as $attr)
			{
				$reg_attrs[$attr['key']] = $attr['type'];
			}
			registry::set($this->_env, registry::attr_index, $this->_table, $reg_attrs);
			return $reg_attrs;
		}
		else
		{
			$l = array(
				'Where' => __METHOD__,
				'What went wrong ?' => 'Sorry, <strong>can\'t find '.$this->_env.' / '.$this->_table.'</strong> definition.',
			);
			sentinel::log(E_ERROR, $l);
		}
	}
/**
 * Générer une requête de type update et la stocker dans le tampon
 *
 * @access	public
 */	
	public function prepare_save()
	{
	//	recherche des attributs
		$attrs = $this->define();
	//	si elle est vide, remplissage auto des champs key
		if (empty($this->data['key'])) $this->data['key'] = md5(uniqid($_SESSION['user']['key'], true));
	//	remplissage auto des dates de création
		if (!isset($this->data['created']) || empty($this->data['created'])) $this->data['created'] = date('Y-m-d H:i:s');
		$this->data['updated'] = date('Y-m-d H:i:s');
	//	premiers pas vers la requête
		foreach ($attrs as $key => $type)
		{
			$attrClass = 'attr'.ucfirst($type);
			$d[$key.self::$count] = (isset($this->data[$key]) && !empty($this->data[$key])) ? $attrClass::set($this->data[$key]) : '';
			$columns[] = '`'.$key.'`';
			$values[] = ':'.$key.self::$count;
			if ($key != 'id') $update[] = '`'.$key.'` = VALUES(`'.$key.'`)';
		}
	//	mise en tampon de la requête
		$q = 'INSERT INTO `'.$this->_table.'` ('.implode(',', $columns).') VALUES __values__ '.PHP_EOL.'ON DUPLICATE KEY UPDATE '.implode(',', $update);
		self::$buffer[$q]['values'][] = '('.implode(',', $values).')';
		self::$buffer[$q]['data'][] = $d;
		self::$count++;
	}
/**
 * Deletes a line in the database
 *
 * @access	public
 */
	public function prepare_delete()
	{
		if (isset($this->data['id']) && !empty($this->data['id']))
		{
			$q = 'DELETE FROM `'.$this->_table.'` WHERE `id` IN (__values__)';
			self::$buffer[$q]['values'][] = ':id'.self::$count;
			self::$buffer[$q]['data'][] = array('id'.self::$count => $this->data['id']);
			self::$count++;
		}
	}
/**
 * Compiler et exécuter les requêtes mises dans le tampon
 *
 * @access	public
 */	
	public function execute()
	{
		// print '<hr><hr><hr><hr><hr><hr><hr><hr><hr><pre>';print_r(self::$buffer);print'</pre><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>';
		if (!empty(self::$buffer))
		{
			foreach (self::$buffer as $query => $param)
			{
				$data = array();
				if (isset($param['values']))
				{
				//	on formatte les values
					$values = PHP_EOL.implode(','.PHP_EOL, $param['values']);
				//	on concatène avec la query
					$query = str_replace('__values__', $values, $query);
				}

			//	on merge les datas
				foreach ($param['data'] as $d)
				{
					$data = array_merge($data, $d);
				}
			//	requête
				$db = database::connect($this->_env);
				$r = $db->query($query, $data);
				if (isset($r['inserted_id']) && !empty($r['inserted_id'])) self::$_inserted_id = $r['inserted_id'];
				// print '<pre>';print_r($query);print'</pre>';
				// print '<pre>';print_r($data);print'</pre>';
			}
		}
		self::$buffer = null;
	//	on ré-initialise le compteur
		self::$count = 0;
		
	}
/**
 * Get last inserted id
 *
 * @access	public
 */
	public function get_last_inserted_id()
	{
		return self::$_inserted_id;
	}
}
?>