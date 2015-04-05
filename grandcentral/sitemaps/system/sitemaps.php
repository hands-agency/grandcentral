<?php
/**
 * The Sitemaps app
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @access		public
 * @link		http://grandcentral.fr
 */
class sitemaps
{
	private $data;
	private $filepath;
	private $appendedUrl;
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
		$app = app('sitemaps');
		$this->filepath = $app->get_templateroot();
	}
	
/**
 * Append an array of URLs to the sitemap
 *
 * @param	array  only site
 * @access	public
 */
	public function append_url($urls)
	{
		$this->appendedUrl = new bunch();
		foreach ($urls as $url)
		{
			$i = new item('page');
			$i['url'] = str_replace('http://grandcentral.fr', '', $url['url']);
			$i['updated'] = $url['updated'];
			$this->appendedUrl[] = $i;
		}
		$this->appendedUrl->count = count($this->appendedUrl);
	}
	
/**
 * Create the sitemap
 *
 * @access	public
 * @return	string	The XML sitemap
 */
	public function create()
	{
	//	Get the items with url
		$items = i('item', array('hasurl' => true));
		
	//	Loop through structures with url
		$url = '';
		foreach ($items as $structure)
		{
		//	Get the items
			switch ($structure['key'])
			{
				case 'page':
					$p = array(
						'status' => 'live',
						'system' => false,
						'type' => '%"content_type":"html"%',
					);
					break;
				
				default:
					$p = array(
						'status' => 'live',
						'system' => false,
					);
					break;
			}
			$items = i($structure['key']->get(), $p);
			
		//	Append or prepend urls
			if (!empty($this->appendedUrl))
			{
				foreach ($this->appendedUrl as $i)
				{
					$items[] = $i;
				}
			}
			$items->count = count($items);
			
		//	Loop through items
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
			case 'never':
				$save = false;
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