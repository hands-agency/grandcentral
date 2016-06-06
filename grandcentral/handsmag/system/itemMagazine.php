<?php
/**
 * Magazines
 *
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemMagazine extends _items
{
/**
 * Save item into database and synchronise article
 *
 * @access  public
 */
	public function save()
	{
		// on sauvegarde l'item courant
		parent::save();
		// recherche des articles liés
		$articles = $this['article']->unfold();
		// mise à jour des données
    if ($articles->count > 0)
    {
      // connexion à la base de données
      $db = database::connect('site');
			// suppression des anciennes relations
			$q = 'UPDATE article SET magazine = "" WHERE magazine = "'.$this->get_nickname().'"';
			$db->query($q);
      // création de la requête
      $q = 'UPDATE article SET magazine = "'.$this->get_nickname().'" WHERE id IN ('.implode(',',$articles->get_column('id')).')';
      $db->query($q);
    }
		// process the good status
		//$this['status'] = $this['workflow']->unfold()->process();
		$this['workflow']->unfold()->process($this);
	}
/**
 * Format date for display
 *
 * @access  public
 */
	public function format_date()
	{
		if ($this['date']->is_empty()) return '';
		return $this['date']->format('d').' '.cst('MONTH_'.$this['date']->format('n')).' '.$this['date']->format('Y');
	}
/**
 * Get the previous magazine
 *
 * @access  public
 */
	public function get_previous()
	{
		if (!registry::get('magazine'))
		{
			$mags = i('magazine', all)->set_index('id');
			registry::set('magazine', $mags);
		}
		else
		{
			$mags = registry::get('magazine');
		}
		$keys = array_keys($mags->data);
		$currentIndex = array_search($this->get_nickname(), $keys);
		switch (true)
		{
			case $currentIndex == 0:
				$index = end($keys);
				break;
			default:
				$index = $keys[$currentIndex - 1];
				break;
		}
		return $mags[$index];
	}
/**
 * Get the next magazine
 *
 * @access  public
 */
	public function get_next()
	{
		if (!registry::get('magazine'))
		{
			$mags = i('magazine', all)->set_index('id');
			registry::set('magazine', $mags);
		}
		else
		{
			$mags = registry::get('magazine');
		}
		$keys = array_keys($mags->data);
		$currentIndex = array_search($this->get_nickname(), $keys);
		switch (true)
		{
			case $currentIndex == count($keys) - 1:
				$index = $keys[0];
				break;
			default:
				$index = $keys[$currentIndex + 1];
				break;
		}
		return $mags[$index];
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
		$source = '';
		// get all the articles
		$articles = $this['article']->unfold();
		// create zip
		$zip = new ZipArchive;
		$t = $zip->open($root, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);

		if ($t === true)
		{
			foreach ($articles as $article)
			{
				// html
				$source .= $article->make_source();
				// images
				foreach ($article['image']->unfold() as $image)
				{
					$zip->addFile($image->get_root(), $image->get_key());
				}
			}
			$source = app('handsmag')->get_snippet('export/layout',array('html' => $source));
			// create html file
			$zip->addFromString($this['title']->cut(50).'.html', $source);
			// close
			$zip->close();
			// return
			return new file($root);
		}

		return false;
	}
}
?>
