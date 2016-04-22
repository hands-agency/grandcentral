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
	private $appendedUrl;
	private $cachename;

/**
 * Class constructor
 *
 * @param	string  only site
 * @access	public
 */
	public function __construct()
	{
	//	Establish the cache name
		$lang = i('version', current)['key']->get();
		$this->cachename = 'sitemap_'.$lang;
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
 * @param	array  The cache lifetime in ms, or using keywords : hourly, daily, weekly
 * @access	public
 */
	public function create($refresh = '86400000', $force_refresh = false)
	{
	//	Translate refresh
		switch ($refresh)
		{
			case 'hourly':
				$refresh = '3600000';
				break;
			case 'daily':
				$refresh = '86400000';
				break;
			case 'weekly':
				$refresh = '604800000';
				break;
		}

	//	Use phpfastcache
		phpfastcache::setup('storage', 'files');
		$cache = phpfastcache();
		if ($force_refresh === true) $cache->delete($this->cachename);

	//	Try to get the cache
		$sitemap = $cache->get($this->cachename);

	//	No cache ?
		if ($sitemap == null)
		{

		//	Get the items with url
			$structures = i('item', array('hasurl' => true));

		//	Loop through structures with url
			$url = '';
			foreach ($structures as $structure)
			{
			//	Get the items
				switch ($structure['key'])
				{
					case 'page':
						$p = array(
							'type' => '%"content_type":"html"%',
						//	'live' => true,
							'status' => 'live',
							'system' => false,
						//	'key' => '',
						);
						break;

					default:
						$p = array(
						//	'live' => true,
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
			$this->data .= "<urlset data-refresh=\"".$refresh."\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
			$this->data .= $url;
			$this->data .= "</urlset>";

		//	Write sitemaps to Cache in 10 minutes with same keyword
			$cache->set($this->cachename, $this->data, $refresh);
		}
	}
/**
 * Get a sitemap
 *
 * @access	public
 */
	public function get()
	{
	//	Use phpfastcache
		phpfastcache::setup('storage', 'files');
		$cache = phpfastcache();
		$sitemap = $cache->get($this->cachename);

		return $sitemap;
	}
}
?>
