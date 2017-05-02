<?php
/**
 * Search through the full text of a database
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class searchFulltext
{
	// nom de la table dans la base de données
	private $key;
	// pondération
	public $relevance = array('title' => 10, 'txt' => 3, 'rel' => 0.5);
	// n'explorez que les items qui ont des urls
	public $url = true;
	// tables blacklistées
	public $notable = array('logbook');
	// relation blacklistées
	public $norel = array('child','section','page');
	// liste des attributs texte
	public $attrTxt = array('attrString','attrI18n','attrSirtrevor');
	// liste des attributs relation
	public $attrRel = array('attrRel', 'attrItem');
	// une bonne vieille statique dégueu pour éviter de faire trop de requêtes
	public static $relTables = array();
/**
 * Sanitize the serach string
 *
 * @param	string	la clef de l'index. Servira pour le nom de la table
 * @access	public
 */
	public function __construct($key)
	{
		ini_set('memory_limit', '1024M');
		set_time_limit(0);

		if (empty($key))
		{
			trigger_error('I need a key.', E_USER_ERROR);
		}
		$this->key = 'sft_'.$key;
	}
/**
 * Sanitize the serach string
 *
 * @param	string	la recherche
 * @return	array	les résultats de la recherche
 * @access	public
 */
	public function sanitize($search)
	{
		return filter_var($search, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	}
/**
 * Search the index and get some items
 *
 * @param	string	la recherche
 * @param	array	les liste d'items à rechercher
 * @param	array	limiter la recherche
 * @return	array	les résultats de la recherche
 * @access	public
 */
	public function search($search, $alloweditems = array(), $limit = null)
	{
		$results = new bunch(null, null, 'site');
		$nicknames = array();
		$r = $this->query($search, $alloweditems, $limit);

		foreach ($r['data'] as $result)
		{
			$nicknames[] = $result['nickname'];
		}

		return $results->get_by_nickname($nicknames);
	}
/**
 * Search into the index filtered by items
 *
 * @param	string	la recherche
 * @param	array	les items à rechercher
 * @param	array	limiter la recherche
 * @return	array	les résultats de la recherche
 * @access	public
 */
	public function search_by_nickname($search, $alloweditems = array(), $limit = null)
	{
		$results = new bunch(null, null, 'site');
		$nicknames = array();
		$r = $this->query($search, null, $limit, $alloweditems);

		foreach ($r['data'] as $result)
		{
			$nicknames[] = $result['nickname'];
		}

		return $results->get_by_nickname($nicknames);
	}
/**
 * Query the index
 *
 * @param	string	la recherche
 * @param	array	les items à rechercher
 * @param	array	limiter la recherche
 * @return	array	les résultats de la recherche
 * @access	public
 */
	public function query($search, $alloweditems = array(), $limit = null, $allowednicknames = array(), $whereExt = null)
	{
		$where = empty($alloweditems) ? '' : 'AND `item` IN ("'.implode('","', $alloweditems).'")';
		$where .= empty($allowednicknames) ? '' : 'AND `nickname` IN ("'.implode('","', $allowednicknames).'")';
		$where .= ($whereExt === null) ? '' : $whereExt;
		$limit = is_null($limit) ? null : 'LIMIT '.$limit;

		$search = $this->sanitize($search);
		$q = '
SELECT `item`, `nickname`,
MATCH (`title`) AGAINST ("'.$search.'" IN NATURAL LANGUAGE MODE) AS title_relevance,
MATCH (`txt`) AGAINST ("'.$search.'" IN NATURAL LANGUAGE MODE) AS txt_relevance,
MATCH (`rel`) AGAINST ("'.$search.'" IN NATURAL LANGUAGE MODE) AS rel_relevance
FROM `'.$this->key.'`
WHERE MATCH (`title`,`txt`,`rel`) AGAINST ("*'.$search.'*" IN NATURAL LANGUAGE MODE)
'.$where.'
ORDER BY (title_relevance*'.$this->relevance['title'].')+(txt_relevance*'.$this->relevance['txt'].')+(rel_relevance*'.$this->relevance['rel'].') DESC
'.$limit.'
		';
		$db = database::connect('site');
		$r = $db->query($q);

		if ($r['count'] == 0)
		{
			$q = '
SELECT `item`, `nickname`,
MATCH (`title`) AGAINST ("*'.$search.'*" IN BOOLEAN MODE) AS title_relevance,
MATCH (`txt`) AGAINST ("*'.$search.'*" IN BOOLEAN MODE) AS txt_relevance,
MATCH (`rel`) AGAINST ("*'.$search.'*" IN BOOLEAN MODE) AS rel_relevance
FROM `'.$this->key.'`
WHERE MATCH (`title`,`txt`,`rel`) AGAINST ("*'.$search.'*" IN BOOLEAN MODE)
'.$where.'
ORDER BY (title_relevance*'.$this->relevance['title'].')+(txt_relevance*'.$this->relevance['txt'].')+(rel_relevance*'.$this->relevance['rel'].') DESC
'.$limit.'
			';
			$r = $db->query($q);
		}

		return $r;
	}
/**
 * Create the search index from items with url
 *
 * @return	array	l'index des contenus
 * @access	public
 */
	public function get_index()
	{
		$p = $this->url ? array('hasurl' => true) : array();
		// recherche des items à indexer. On prendi
		$items = i('item', $p, 'site');
		// construction de l'index
		$toindex = array();
		foreach ($items as $item)
		{
			$toindex = array_merge($toindex, $this->prepare_items($item['key']->get()));
		}

		return $toindex;
	}
/**
 * Put index into bdd
 *
 * @access	public
 */
	public function save_index()
	{
		$this->create_table();
	//	Some vars
		$i = 0;
		$e = 0;
	//	Insert lines by sets of...
		$lines = 100;
		foreach ($this->get_index() as $row)
		{
			$values[$e][] = '("'.$row['item'].'", "'.$row['nickname'].'", "'.$row['title'].'", "'.$row['txt'].'", "'.$row['rel'].'")';
			$i++;
			if ($i == $lines)
			{
				$i = 0;
				$e++;
			}
		}

		$db = database::connect('site');
		$q = 'TRUNCATE TABLE `'.$this->key.'`;';
		$db->query($q);
		foreach ($values as $value)
		{
			$q = 'INSERT INTO `'.$this->key.'` (`item`, `nickname`, `title`, `txt`, `rel`) VALUES '.implode(',', $value).';';
			$db->query($q);
		}
	}
/**
 * Prepare a table for indexing
 *
 * @param	string	la table à parser
 * @return	array	l'index de la table
 * @access	public
 */
	public function prepare_items($table)
	{
		$toindex = array();

		if (!in_array($table, $this->notable))
		{
			foreach (i($table, all, 'site') as $item)
			{
				$toindex[] = $this->prepare_item($item);
			}
		}

		return $toindex;
	}
/**
 * Prepare an item for indexing
 *
 * @param	_items	l'item à parser
 * @return	array	l'item parsé
 * @access	public
 */
	public function prepare_item(_items $item, $norelation = false)
	{
	//	Use the key as a failsafe for title
		if (isset($item['title']))
		{
			$title = $this->prepare_attr($item['title']);
			$item['title'] = '';
		}
		else $title = $item['key'];

		// tableau de retour
		$toindex = array(
			'item' => $item->get_table(),
			'nickname' => $item->get_nickname(),
			'title' => $title,
			'txt' => '',
			'rel' => ''
		);
		// boucle sur les attributs
		foreach ($item as $attr)
		{
			$class = get_class($attr);
			switch (true)
			{
				// string
				case in_array($class, $this->attrTxt):
					$toindex['txt'] .= $this->prepare_attr($attr);
					break;
				// rel
				case in_array($class, $this->attrRel) && !$norelation:
					$toindex['rel'] .= $this->prepare_rel($attr);
					break;
			}
		}

		return $toindex;
	}
/**
 * Prepare an text attribute for indexing
 *
 * @param	_attrs	l'attribut à parser
 * @return	string	l'attribut parsé
 * @access	public
 */
	public function prepare_attr(_attrs $attr)
	{
		$toindex = null;
		$raw = $attr->get();
		// traitement des tableaux
		$value = (is_array($raw)) ? $this->flat_array($raw) : $raw;
		// traitement du json
		$jsondecode = json_decode($value, true);
		if (!empty($jsondecode) && json_last_error() == JSON_ERROR_NONE)
		{
			$tmp = $jsondecode;
			if (is_array($tmp))
			{
				$value = $this->flat_array($tmp);
			}
		}
		// suppression du html
		$value = strip_tags($value);
		// suppression du slashs
		$toindex = str_replace(array('\\', '"'), array('', ' '), $value);

		return $toindex;
	}
/**
 * Prepare an text attribute for indexing
 *
 * @param	_attrs	l'attribut à parser
 * @return	string	l'attribut parsé
 * @access	public
 */
	public function flat_array(array $array)
	{
		$flat = null;

		$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
		foreach($it as $v)
		{
			$flat .= $v.' ';
		}

		return $flat;
	}
/**
 * Prepare a relation for indexing
 *
 * @param	_attrs	attribute to parse
 * @return	string	Parsed attribute
 * @access	public
 */
	public function prepare_rel(_attrs $attr)
	{
		$toindex = null;
		$rels = (array) $attr->get();
		// hack cast défectueux
		if (isset($rels[0]) && empty($rels[0])) $rels = array();
		// pour limiter les requêtes, stocke toutes les données dans une statique
		if (!empty($rels) && !in_array($attr->get_key(), $this->norel))
		{
			foreach ($rels as $rel)
			{
				if (!empty($rel))
				{
					// print'<pre>';print_r($rel);print'</pre>';
					if (!isset(self::$relTables[$rel]))
					{
						foreach (i(explode('_', $rel)[0], all, 'site') as $item)
						{
							$tmp = $this->prepare_item($item, true);
							unset($tmp['table'], $tmp['nickname']);
							self::$relTables[$item->get_nickname()] = $this->flat_array($tmp);
						}
					}
					if (isset(self::$relTables[$rel]))
					{
						$toindex .= ' '.self::$relTables[$rel];
					}

				}
			}

		}
		// print'<pre>';print_r($toindex);print'</pre>';
		return $toindex;
	}
/**
 * Clean the data for indexing
 *
 * @param	array	tableau de paramètres
 * @access	public
 */
	public function cleandata($data)
	{
		switch (true) {
			case is_array($data):
				$data = implode(' ',$data);
				break;

			default:
				$data = strip_tags($data);
				break;
		}

		return $data;
	}
/**
 * Create the index table
 *
 * @param	array	tableau de paramètres
 * @access	public
 */
	public function create_table()
	{
		$db= database::connect('site');
		$q = '
		DROP TABLE IF EXISTS `'.$this->key.'`;
		CREATE TABLE `'.$this->key.'`
		(
			`item` varchar(32) COLLATE '.database::collation.' NOT NULL,
			`nickname` varchar(64) COLLATE '.database::collation.' NOT NULL,
			`title` varchar(255) COLLATE '.database::collation.' NOT NULL,
			`txt` text COLLATE '.database::collation.' NOT NULL,
			`rel` text COLLATE '.database::collation.' NOT NULL,
			KEY `item` (`item`),
			PRIMARY KEY `nickname` (`nickname`),
			FULLTEXT KEY `all` (`title`,`txt`,`rel`),
			FULLTEXT KEY `titre` (`title`),
			FULLTEXT KEY `txt` (`txt`),
			FULLTEXT KEY `rel` (`rel`)
		) ENGINE=MyISAM DEFAULT CHARSET='.database::charset.' COLLATE='.database::collation.';';
		$db->query($q);
	}
}
?>
