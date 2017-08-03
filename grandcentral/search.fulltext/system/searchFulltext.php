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
	public function create_index()
	{
		$p = $this->url ? array('hasurl' => true) : array();
		// recherche des items à indexer. On prendi
		$items = i('item', $p, 'site');
		foreach ($items as $item)
		{
			$this->prepare_items($item['key']->get());
		}
	}
/**
 * Put index into bdd
 *
 * @access	public
 */
	public function save_index()
	{
		$this->create_table();
		$this->create_index();


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
		$limit = 100;
		$start = 0;
		$max = count::get($table, [], 'site');

		if (!in_array($table, $this->notable))
		{
			$i = 0;
			while ($i <= $max)
			{
				$p = ['limit()' => $i.', '.$limit];
				foreach (i($table, $p, 'site') as $item)
				{
					$this->save_item($item);
				}
				$i += 100;
			}
			$start += $limit;
		}

		// echo $table.' : '.$max.PHP_EOL;
		echo $table.' done'.PHP_EOL;
		// return $toindex;
	}
/**
 * Prepare an item for indexing
 *
 * @param	_items	l'item à parser
 * @return	array	l'item parsé
 * @access	public
 */
	public function save_item(_items $item, $norelation = false)
	{
		set_time_limit(2);
		$data = $this->prepare_item($item, $norelation);
		$db = database::connect('site');
		$q = 'TRUNCATE TABLE `'.$this->key.'`;';
		$q = 'INSERT INTO `'.$this->key.'` (`item`, `nickname`, `title`, `txt`, `rel`) VALUES ("'.$data['item'].'","'.$data['nickname'].'","'.$data['title'].'","'.$data['txt'].'","'.$data['rel'].'");';
		$db->query($q);
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
		$value = trim(strip_tags($value));
		// suppression du slashs
		$toindex = str_replace(array('\\', '"', '&#039;'), array('', ' ','\''), $value);

		return ' '.$toindex.' ';
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
		$toindex = '';

		if (!$attr->is_empty())
		{
			$rels = new bunch(null,null,'site');
			// print_r($attr->get());echo PHP_EOL;
			$rels->get_by_nickname($attr->get());

			foreach ($rels as $rel)
			{
				$tmp = $this->prepare_item($rel, true);
				// echo "<pre>";print_r($this->flat_array($tmp));echo "</pre>";
				unset($tmp['table'], $tmp['nickname']);
				$toindex .= ' '.$this->flat_array($tmp);
			}
		}

		return $toindex;
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
