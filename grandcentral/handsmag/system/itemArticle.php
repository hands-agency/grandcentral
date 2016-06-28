<?php
/**
 * Projects
 *
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemArticle extends _items
{
	protected static $topics;
	protected $zip_dir;
/**
 * Save item into database and sync with the magazine
 *
 * @access  public
 */
	public function save()
	{
		if (!$this['magazine']->is_empty())
		{
			// recherche du magazine lié avec le présent article
			$mag = $this['magazine']->unfold();
			// echo "<pre>".$this['id']->get();print_r($mag);echo "</pre>";
			// date de création synchronisée avec la date de publication du magazine
			$this['created'] = isset($mag['date']) ? $mag['date']->get() : '';
		}
		// sauvegarde de l'item courant
		parent::save();
		// mise à jour du magazine
		if (!$this['magazine']->is_empty())
		{
			$articles = array_keys($mag['article']->unfold()->set_index('id')->data);
			// mise à jour du magazine
			if ($mag->exists() && !in_array($this->get_nickname(), $articles))
			{
				$db = database::connect('site');
				// on efface la précédente entrée liée à l'article
				$q = 'DELETE FROM `_rel` WHERE `item` = "magazine" AND `rel` = "article" AND `relid` = '.$this['id'];
				$db->query($q);
				// création de la nouvelle liaison
				$q = 'INSERT INTO `_rel` (`item`,`itemid`,`key`,`rel`,`relid`,`position`) VALUES ("magazine",'.$mag['id'].',"article","article",'.$this['id'].','.count($articles).')';
				$db->query($q);
			}
		}
	}
/**
 * Format description
 *
 * @access  public
 */
	public function get_descr()
	{
		return $this['descr']->is_empty() ? $this['text']->cut('150') : $this['descr'];
	}
/**
 * Format date for display
 *
 * @access  public
 */
	public function get_topic()
	{
		if (empty(self::$topics))
		{
			self::$topics = i('topic', all)->set_index('id');
		}
		$topic = !$this['topic']->is_empty() ? self::$topics[$this['topic']->get()] : i('topic');
		return $topic;
	}
/**
 * Get export url
 *
 * @access  public
 */
	public function get_source()
	{
		$url = registry::get('exportzip');
		if (!$url)
		{
			$url = i('page','exportzip')['url'];
			registry::set('exportzip',$url);
		}
		$url .= '?item='.$this->get_nickname();
		// return
		return $url;
	}
/**
 * make the html source
 *
 * @access  public
 */
	public function make_source($layout = false)
	{
		$app = app('handsmag');
		$html = $app->get_snippet('export/article',array('article' => $this));
		if ($layout === true)
		{
			$html = $app->get_snippet('export/layout',array('html' => $html));
		}
		// return
		return $html;
	}
/**
 * Get zip file
 *
 * @access  public
 */
	public function get_zip()
	{
		// vars
		$this->zip_dir = app('cache')->get_templateroot('site').'/zip/';
		$zip = new file($this->zip_dir.$this['title']->cut(50).'.zip');
		// create destination dir if not exists
		if (!is_dir($this->zip_dir))
			mkdir($this->zip_dir, 0755);
		// delete zip if article is has been modified
		if ($zip->exists() && $zip->get_updated() < $this['updated']->format('Y-m-d H:i:s'))
			$zip->delete();
		// generate zip file
		if (!$zip->exists())
			$zip = $this->make_zip($zip->get_root());
		// return
		return $zip;
	}
/**
 * Create a zip with article data and return a zip url
 *
 * @access  public
 */
	public function make_zip($root)
	{
		// create zip
		$zip = new ZipArchive;
		$t = $zip->open($root, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);

		if ($t === true)
		{
			// html
			$zip->addFromString($this['title']->cut(50).'.html', $this->make_source(true));
			// images
			foreach ($this['image']->unfold() as $image)
			{
				$zip->addFile($image->get_root(), $image->get_key());
			}
			// close
			$zip->close();
			// return
			return new file($root);
		}

		return false;
	}
}
?>
