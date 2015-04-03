<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrYoutube extends _attrs
{
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (string) $data;
		return $this;
	}
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_format($data)
	{
		$this->params['format'] = (in_array($data, array('video', 'playlist'))) ? $data : 'video';
		return $this;
	}
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get_format()
	{
		return $this->params['format'];
	}
/**
 * Make the thumbnail of a youtube video
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function thumbnail()
	{
		switch ($this->params['format'])
		{
			case 'video':
				$url = 'http://img.youtube.com/vi/'.$this->get().'/0.jpg';
				break;
			case 'playlist':
				$this->get_api_info();
				$pattern = '/\?v=([^&]*)/';
				$subject = (string) $this->xml->entry[0]->link[0]['href'];
				preg_match($pattern, $subject, $matches);
				$url = 'http://img.youtube.com/vi/'.$matches[1].'/mqdefault.jpg';
				break;
		}
		return '<img src="'.$url.'" />';
	}
/**
 * Make the thumbnail of a youtube video
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get_embed_url()
	{
		$urls = array(
			'video' => '//www.youtube.com/embed/',
			'playlist' => '//www.youtube.com/embed/?list='
		);
		return $urls[$this->params['format']].$this->get();
	}
/**
 * Make the thumbnail of a youtube video
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get_iframe($params = array())
	{
		$default = array(
			'width' => 420,
			'height' => 315,
			'frameborder' => 0,
			'allowfullscreen' => true
		);
		$params = array_merge($default, $params);
		
		$iframe = '<iframe width="'.$params['width'].'" height="'.$params['height'].'" src="'.$this->get_embed_url().'" frameborder="'.$params['frameborder'].'" allowfullscreen></iframe>';
		return $iframe;
	}
/**
 * get API info from the youtube id
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function get_api_info()
	{
		if (empty($this->xml))
		{
			$urls = array(
				'video' => 'http://gdata.youtube.com/feeds/api/videos/',
				'playlist' => 'http://gdata.youtube.com/feeds/api/playlists/'
			);
		
			$this->xml = simplexml_load_file($urls[$this->params['format']].$this->get());
		}
		return $this->xml;
	}
/**
 * Definition mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` varchar(255) CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
/**
 * Default field attributes for String	
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		$params['format'] = array(
			'name' => 'format',
			'type' => 'select',
			'label' => 'Format',
			'values' => array('video' => 'video', 'playlist' => 'playlist'),
			'valuestype' => 'array'
		);
	//	Return
		return $params;
	}
}
?>