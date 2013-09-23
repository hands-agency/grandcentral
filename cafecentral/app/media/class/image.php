<?php
/**
 * The group item of Café Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class image extends media
{
	protected $width;
	protected $height;

/**
 * Obtenir, s'il existe, le contenu du fichier
 *
 * @return	string	le contenu du fichier
 * @access	public
 */
	public function get()
	{
		if ($this->exists() && empty($this->data))
		{
			$info = getimagesize($this->root);
			$this->mime = $info[2];
			$this->width = $info[0];
			$this->height = $info[1];
		
			if ($this->mime == IMAGETYPE_JPEG)
			{
			   $this->data = imagecreatefromjpeg($this->root);
			}
			elseif ($this->mime == IMAGETYPE_GIF)
			{
				$this->data = imagecreatefromgif($this->root);
			}
			elseif ($this->mime == IMAGETYPE_PNG)
			{
				$this->data = imagecreatefrompng($this->root);
			}
		}
		return $this->data;
	}

/**
 * Sauvegarder une image
 *
 * @param	bool	créer le répertoire du fichier si celui-ci n'existe pas. "false" par défaut.
 * @access	public
 */
	public function save($mkdir = false, $chmod = 0755, $quality = 75)
	{
		if (!is_dir($this->dir) && $mkdir === true) mkdir($this->dir, $chmod, true);
		
		if($this->get_mime() == IMAGETYPE_JPEG)
		{
			imagejpeg($this->data, $this->root, $quality);
      	}
		elseif( $this->get_mime() == IMAGETYPE_GIF )
		{
 			imagegif($this->data, $this->root);
      	}
		elseif($this->get_mime() == IMAGETYPE_PNG)
		{
 			imagepng($this->data, $this->root);
		}
		
		// chmod($this->root, $chmod);
	}

/**
 * Retourne la hauteur de l'image
 *
 * @access	public
 */
	public function get_height()
	{
		if ($this->exists() && empty($this->height))
		{
			$tmp = getimagesize($this->root);
			$this->width = $tmp[0];
			$this->height = $tmp[1];
		}
		return $this->height;
	}
	
/**
 * Retourne la largeur de l'image
 *
 * @access	public
 */
	public function get_width()
	{
		if ($this->exists() && empty($this->height))
		{
			$tmp = getimagesize($this->root);
			$this->width = $tmp[0];
			$this->height = $tmp[1];
		}
		return $this->width;
	}
	
/**
 * Retourne le chemin vers le thumbnail
 *
 * @access	public
 */
	public function thumbnail($width, $height, $quality = 75)
	{
		$root = SITE_CACHE_ROOT.'/media/thumbnail_w'.$width.'_h'.$height;
		$thumb = new image($root.'/'.$this->get_key());
	//	création du thumbnail
		if (!$thumb->exists())
		{
			$this->copy($root);
			$thumb = new image($root.'/'.$this->get_key());
			$thumb->resize($width, $height, true);
			$thumb->save(true);
		}
		
		return $thumb->get_url();
	}
	
/**
 * Redimensionne une image
 * 
 * http://www.white-hat-web-design.co.uk/blog/retaining-transparency-with-php-image-resizing/
 *
 * @access	public
 */
	public function resize($width, $height, $keep_proportions = true)
	{
		if (!$this->exists() || (empty($width) && empty($height))) return $this;
		$this->get();
	//	si on ne reçoit que la largeur
		if (empty($height))
		{
			$ratio = $width / $this->get_width();
			$height = $this->get_height() * $ratio;
		}
	//	si on ne reçoit que la hauteur
		if (empty($width))
		{
			$ratio = $width / $this->get_height();
			$height = $this->get_width() * $ratio;
		}
	//	si on souhaite garder les proportions de l'image
		if ($keep_proportions === true)
		{
			// print '<pre>original ratio : ';print_r($this->get_width()/$this->get_height());print'</pre>';
			// print '<pre>new ratio : ';print_r($width/$height);print'</pre>';
			if ($this->get_width() / $this->get_height() >= $width/$height) $height = 0;
			else $width = 0;
			
			if ($width == 0) $width = $height / $this->get_height() * $this->get_width();
			if ($height == 0) $height = $width / $this->get_width() * $this->get_height();
		}
		// print '<pre>width / original : '.$this->get_width().' / new : ';print_r($width);print'</pre>';
		// print '<pre>height / original : '.$this->get_height().' / new : ';print_r($height);print'</pre>';
		
		$new_image = imagecreatetruecolor($width, $height);
		
		if ($this->mime == IMAGETYPE_GIF || $this->mime == IMAGETYPE_PNG)
		{
			$current_transparent = imagecolortransparent($this->data);
			if($current_transparent != -1)
			{
				$transparent_color = imagecolorsforindex($this->data, $current_transparent);
				$current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
				imagefill($new_image, 0, 0, $current_transparent);
				imagecolortransparent($new_image, $current_transparent);
			}
			elseif( $this->mime == IMAGETYPE_PNG)
			{
				imagealphablending($new_image, false);
				$color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
				imagefill($new_image, 0, 0, $color);
				imagesavealpha($new_image, true);
			}
		}
		
		imagecopyresampled($new_image, $this->data, 0, 0, 0, 0, $width, $height, $this->get_width(), $this->get_height());
		
		$this->data = $new_image;
		unset($new_image);
		return $this;
	}

	/**
	 * Prints the image in a <img tag>
	 *
	 * @access	public
	 */
		public function __tostring()
		{
			return '<img src="'.$this->get_url().'" />';
		}
}
?>