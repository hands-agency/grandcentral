<?php
/**
 * The Sitemaps app
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class sitemaps
{
	private $data;
	private $filepath;
	private $filename = '/sitemap.xml.php';

/**
 * Class constructor
 *
 * @param	string  only site
 * @access	public
 */
	public function __construct()
	{
	//	Find the root
		$app = new app('sitemaps');
		$this->filepath = $app->get_templateroot();
	}
	
/**
 * Create the sitemap
 *
 * @param	string  only site
 * @access	public
 */
	public function create()
	{
	//	Get the structures with url
		$items = i('item', array('hasurl' => true));
	//	Loop through structures with url
		$url = null;
		foreach ($items as $structure)
		{
		//	Get the items
			$items = i($structure['key']->get(), array('status' => 'live'));
			foreach ($items as $item)
			{
				$url .= "<url>\n";
				$url .= "	<loc>".$item["url"]."</loc>\n";
				$url .= "	<lastmod>".$item["updated"]->format("Y-m-d")."</lastmod>\n";
			//	$url .= "	<changefreq>todo</changefreq>\n";
			//	$url .= "	<priority>todo</priority>\n";
				$url .= "</url>\n";
			}
		}
		
	//	Encapsulate

		$this->data .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
		$this->data .= $url;
		$this->data .= "</urlset>";
	}

/**
 * Save the sitemap
 *
 * @param	string  save frequency : always (default), hourly, daily, weekly, monthly, yearly, never
 * @access	public
 */
	public function save($frequency = 'always')
	{
	//	Path
		$path = $this->filepath.$this->filename;
	//	Get today and last update
		$today = new dateTime('today');
		$lastupdate = (is_file($path)) ? date('Y-m-d', filemtime($path)) : null;
		
	//	Save depending on frequency
		switch ($frequency)
		{
			case 'always':
				$save = true;
				break;
			case 'daily':
				$save = ($today->format('Y-m-d') == $lastupdate) ? false : true;
				break;
		}
		
	//	To save or not to save
		if ($save === true)
		{
			$file = new file($path);
			$file->set($this->data);
			$file->save();
		}
	}
}
?>