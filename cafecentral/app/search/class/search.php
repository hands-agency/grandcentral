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
	
	public function install()
	{
		$q = 'CREATE TABLE `search_fulltext` (
		 `item` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
		 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		 `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
		 `txt` text COLLATE utf8_unicode_ci NOT NULL,
		 KEY `objet` (`item`,`id`),
		 FULLTEXT KEY `all` (`titre`,`txt`),
		 FULLTEXT KEY `titre` (`titre`),
		 FULLTEXT KEY `txt` (`txt`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci';
	}
	
	public function build_index($params)
	{
		
	}
	
	private function _get_attr($item, $attr_to_index)
	{
		
	}
	
	private function _get_rel($item, $rel_to_index = array())
	{
		
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
		MATCH (`titre`) AGAINST ("'.$search.'" IN BOOLEAN MODE) AS titre_relevance,
		MATCH (`txt`) AGAINST ("'.$search.'" IN BOOLEAN MODE) AS txt_relevance
		FROM `'.self::table.'`
		WHERE MATCH (`titre`,`txt`) AGAINST ("'.$search.'" IN BOOLEAN MODE)
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