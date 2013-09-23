<?php
#********************************************************************************************#
//////////////////////////////////////////////////////////////////////////////////////////////
/**	* Convertir une base de données
	* @package		tool
	* @copyright	2004-2009 This website
	* @licence		Under licence, as specified in the licence.txt file
	* @description	From here, you'll find the available variables to work, in the $THISpage array
	* @help			Check http://www.cafecentral.fr/fr/wiki/ for help
//////////////////////////////////////////////////////////////////////////////////////////////
*/#******************************************************************************************#

class search
{
	const table = 'search_fulltext';
	private $params = array();
	
	public function build_index($params)
	{
	//	chargement de l'index existant
		$q = 'SELECT `item`, `id` FROM `'.self::table.'`';
		// print '<pre>';print_r($q);print'</pre>';
		$tmp = query($q);
		for ($i=0; $i < $tmp['count']; $i++)
		{
			$oIndex[$tmp[$i]['item']][] = $tmp[$i]['id'];
		}
		unset($tmp);
		// print '<pre>';print_r($oIndex);print'</pre>';
		
	//	création du nouvel index
		$insert = $update = 0;
		foreach ($params as $param)
		{
		//	recherche des objets à indexer
			$qitems = queryobjet($param['item'], $param['param'], true);
			// print '<pre>';print_r($qitems);print'</pre>';
		//	création de l'index
			for ($i=0; $i < $qitems['count']; $i++)
			{
			//	hack pour supprimer les liens et le lexique
				if (isset($qitems[$i]['page_feed']) && in_array($qitems[$i]['page_feed'], array(99, 98))) continue;
			//	affectation de la table
				$index['item'] = $param['item'];
			//	id
				$index['id'] = $qitems[$i]['id'];
			//	titre
				$index['titre'] = addslashes($qitems[$i]['titre']);
			//	txt de puis les attributs
				$index['txt'] = $this->_get_attr($qitems[$i], $param['attr']);
			//	txt depuis les relations
				$index['txt'] .= $this->_get_rel($qitems[$i], $param['rel']);
				// print '<pre>';print_r($index);print'</pre>';
			//	sauvegarde
				if (in_array($index['id'], (array) $oIndex[$index['item']]))
				{
					$this->_update_index($index);
					$update++;
				}
				else
				{
					$this->_insert_index($index);
					$insert++;
				}
			}
		}
		return array('insert' => $insert, 'update' => $update);
	}
	
	private function _get_attr($item, $attr_to_index)
	{
		$txt = '';
		foreach ($attr_to_index as $attr) 
		{
			if (isset($item[$attr]) && !empty($item[$attr]))
			{
				$txt .= strip_tags($item[$attr].PHP_EOL);
			}
		}
		return addslashes($txt);
	}
	
	private function _get_rel($item, $rel_to_index = array())
	{
		static $rels;
	//	Recerhche des relations - hack pour les liens
		if (empty($rels))
		{
			$param = array('page_feed' => 99);
			$tmp = queryobjet('article', $param, false);
			// print '<pre>';print_r($tmp);print'</pre>';
			for ($i=0; $i < $tmp['count']; $i++)
			{
				$rels['article_99'][$tmp[$i]['id']] = $this->_get_attr($tmp[$i], array('titre', 'chapo'));
			}
			// print '<pre>';print_r($rels);print'</pre>';
		}
	//	affectation
		$txt = '';
		foreach ($rel_to_index as $rel)
		{
			if (isset($item[$rel]) && !empty($item[$rel]))
			{
				// print '<pre>';print_r($item[$rel]);print'</pre>';
				foreach ((array) $item[$rel] as $value)
				{
					if (isset($rels['article_99'][$value]))
					{
						$txt .= $rels['article_99'][$value].PHP_EOL;
					}
				}
				
			}
		}
		return $txt;
	}
	
	public function query($search)
	{
		// SELECT `item`, `id`,
		// MATCH (`titre`) AGAINST ("'.$search.'*" IN BOOLEAN MODE) AS titre_relevance,
		// MATCH (`txt`) AGAINST ("'.$search.'*" IN BOOLEAN MODE) AS txt_relevance
		// FROM `'.self::table.'`
		// WHERE MATCH (`titre`,`txt`) AGAINST ("'.$search.'*" IN BOOLEAN MODE)
		// ORDER BY (titre_relevance*1.5)+(txt_relevance) DESC
		$search = mysql_real_escape_string($search);
		$q = '
		SELECT `item`, `id`,
		MATCH (`titre`) AGAINST ("'.$search.'") AS titre_relevance,
		MATCH (`txt`) AGAINST ("'.$search.'") AS txt_relevance
		FROM `'.self::table.'`
		WHERE MATCH (`titre`,`txt`) AGAINST ("'.$search.'")
		ORDER BY (titre_relevance*1.5)+(txt_relevance) DESC
		';
		// print '<pre>';print_r($q);print'</pre>';
		$r = query($q);
		
		if ($r['count'] == 0)
		{
			$q = '
			SELECT `item`, `id`,
			MATCH (`titre`) AGAINST ("'.$search.'*" IN BOOLEAN MODE) AS titre_relevance,
			MATCH (`txt`) AGAINST ("'.$search.'*" IN BOOLEAN MODE) AS txt_relevance
			FROM `'.self::table.'`
			WHERE MATCH (`titre`,`txt`) AGAINST ("'.$search.'*" IN BOOLEAN MODE)
			ORDER BY (titre_relevance*1.5)+(txt_relevance) DESC
			';
			// print '<pre>';print_r($q);print'</pre>';
			$r = query($q);
		}
		
		return $r;
	}
	
	private function _insert_index($index)
	{
		$q = '
		INSERT INTO `'.self::table.'` (`item`, `id`, `titre`, `txt`) 
		VALUES ("'.$index['item'].'", '.$index['id'].', "'.mysql_real_escape_string($index['titre']).'", "'.mysql_real_escape_string($index['txt']).'")
		';
		
		mysql_query($q) or die(mysql_error().'<br />'.$q);
		// print '<pre>';print_r($q);print'</pre>';
	}
	
	private function _update_index($index)
	{
		$q = '
		UPDATE `'.self::table.'` 
		SET `titre` = "'.mysql_real_escape_string($index['titre']).'", `txt` = "'.mysql_real_escape_string($index['txt']).'"
		WHERE `item` = "'.$index['item'].'" AND `id` = '.$index['id'].'
		LIMIT 1
		';
		
		mysql_query($q) or die(mysql_error().'<br />'.$q);
		// print '<pre>';print_r($q);print'</pre>';
	}
}
?>