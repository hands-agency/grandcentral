<?php
/**
 * News object
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemNews extends _items
{
	private $pushlimit = 3;
/**
 * Sauvegarde et remplissage auto
 *
 * @access	public
 */
	public function save()
	{
		// capeb d'apartenance
		if ($this['capeb']->is_empty())
		{
			$national = i('capeb',itemCapeb::FALLBACK);
			$this['capeb']->set($national->get_nickname());
		}
		// date par défaut
		if ($this['date']->is_empty())
		{
			$this['date'] = date('Y-m-d h:i:s');
		}
		// sauvegarde
		parent::save();

    return $this;
	}
/**
 * Détermine la categorie de service contenant le service
 *
 * @access	public
 */
	public static function get_months()
	{
		//
    $db = database::connect();
		$response = $db->query('SELECT DATE_FORMAT(date, "%Y-%m") AS created_month FROM news GROUP BY created_month ORDER BY created_month DESC');

		$data = [];
		foreach ($response['data'] as $value)
		{
			$data[$value['created_month']] = $value['created_month'];
		}

    return $data;
	}
/**
 * Get next and previous news in a bunch
 *
 * @access	public
 */
	public function get_previous()
	{
		// capeb
		$capeb = $_SESSION['capeb'];
		switch ($capeb['type']->get())
		{
			case 'departement':
				$params['capeb'] = array($capeb->get_nickname(), dataCapeb::FALLBACK);
				$region = i('capeb', array('departement' => $capeb->get_nickname()));
				if ($region->count > 0)
				{
					$params['capeb'][] = $region[0]->get_nickname();
				}
				break;
			case 'region':
				$params['capeb'] = array_merge($capeb['departement']->get(), array($capeb->get_nickname(), dataCapeb::FALLBACK));
				break;
			case 'national':
				$params['capeb'] = $capeb->get_nickname();
				break;
		}

		$article = i($this->get_table(), array(
			'id' => '!='.$this['id']->get(),
			'date' => '<='. $this['date']->get(),
			'capeb' => $params['capeb'],
			'limit()' => 1
		));
    return $article->count == 1 ? $article[0] : i('news');
	}
/**
 * Get next and previous news in a bunch
 *
 * @access	public
 */
	public function get_next()
	{
		// capeb
		$capeb = $_SESSION['capeb'];
		switch ($capeb['type']->get())
		{
			case 'departement':
				$params['capeb'] = array($capeb->get_nickname(), dataCapeb::FALLBACK);
				$region = i('capeb', array('departement' => $capeb->get_nickname()));
				if ($region->count > 0)
				{
					$params['capeb'][] = $region[0]->get_nickname();
				}
				break;
			case 'region':
				$params['capeb'] = array_merge($capeb['departement']->get(), array($capeb->get_nickname(), dataCapeb::FALLBACK));
				break;
			case 'national':
				$params['capeb'] = $capeb->get_nickname();
				break;
		}
		$article = i($this->get_table(), array(
			'id' => '!='.$this['id']->get(),
			'date' => '>='. $this['date']->get(),
			'capeb' => $params['capeb'],
			'limit()' => 1
		));
    return $article->count == 1 ? $article[0] : i('news');
	}
/**
 * Get news for aside column
 *
 * @access	public
 */
	public function get_push()
	{
		if ($this['push']->is_empty())
		{
			$capeb = new dataCapeb();
			$articles = $capeb->get_news(3);
  		unset($articles['total']);
		}
		else
		{
			$articles = $this['push']->unfold(array(
				'limit()' => $this->pushlimit
			));
		}
    return $articles->count > 0 ? $articles : new bunch();
	}
}
?>
