<?php
/**
 * File handling class
 * 
 * Check http://stackoverflow.com/questions/11061355/security-threats-with-uploads
 *
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class file
{
	protected $key;
	protected $name;
	protected $dir;
	protected $url;
	protected $root;
	protected $data;
	protected $size;
	protected $extension;
	protected $mime;
	protected $mimeType;
	protected $mimeSubtype;
	protected $created;
	protected $updated;

/**
 * Crée un objet "fichier" défini par son chemin
 *
 * @param	string  le chemin de l'objet
 * @access	public
 */	
	public function __construct($root)
	{
		$this->root = $root;
		$this->_set_var();
	}

/**
 * Remplir les propriétés de l'objet
 *
 * @access	private
 */
	protected function _set_var()
	{
		$this->key = mb_substr($this->root, mb_strrpos($this->root, '/') + 1);
		$this->name = mb_substr($this->key, 0, mb_strrpos($this->key, '.'));
		$this->dir = dirname($this->root);
		// $this->url = DOMAIN_URL.mb_substr($this->root, mb_strlen(DOCUMENT_ROOT));
		$this->url = DOMAIN_URL.mb_substr(str_replace(' ', '%20', $this->root), mb_strlen(DOCUMENT_ROOT));
	}

/**
 * Obtenir, s'il existe, le contenu du fichier
 *
 * @return	string	le contenu du fichier
 * @access	public
 */
	public function get()
	{
		if (empty($this->data) && $this->exists() === true) $this->data = file_get_contents($this->root, FILE_TEXT);
		return $this->data;
	}

/**
 * Replace the content of a file with data
 *
 * @param	string	The data to use
 * @access	public
 */
	public function set($data)
	{
		$this->data = $data;
	}

/**
 * Sauvegarder un fichier
 *
 * @param	bool	Create the directory if it doesn't exist. Default: "false".
 * @access	public
 */
	public function save($mkdir = false)
	{
		if (!is_dir($this->dir) && $mkdir === true) mkdir($this->dir, 0775, true);
		file_put_contents($this->root, $this->data);
	}
	
/**
 * Copy a file
 *
 * @param	string	The destination path
 * @access	public
 */
	public function copy($dir, $key = null)
	{
		if (!is_dir($dir)) mkdir($dir, 0775, true);
		
		if (is_null($key)) $key = $this->key;
		copy($this->root, $dir.'/'.$key);
	}

/**
 * Move the file
 *
 * @param	string	The destination path
 * @access	public
 */
	public function move($path)
	{
		$this->copy($path);
		$this->delete();
		$this->_set_var();
	}

/**
 * Delete the file
 *
 * @access	public
 */
	public function delete()
	{
		if ($this->exists()) return unlink($this->root);
	}

/**
 * Check if a file exists
 *
 * @return	bool	true ou false
 * @access	public
 */
	public function exists()
	{
		return is_file($this->root);
	}
	
/**
 * Append content to the file
 *
 * @param	string	The content to append
 * @access	public
 */
	public function combine_string($data)
	{
		$this->data .= $data;
	}
	
/**
 * Append content of another file to the file
 *
 * @param	string	The path to the other file
 * @access	public
 */
	public function combine_file($path)
	{
		$file = new file($path);
		$this->data .= $file->get();
	}
	
/**
 * Get the file directory
 *
 * @access	public
 * @return	string	The file directory
 */
	public function get_dir()
	{
		return $this->dir;
	}
	
/**
 * Get the file root
 *
 * @access	public
 * @return	string	The file root
 */
	public function get_root()
	{
		return $this->root;
	}
	
/**
 * Get the file URL
 *
 * @access	public
 * @return	string	The file URL
 */
	public function get_url()
	{
		// print'<pre>';print_r($absolute);print'</pre>';
		return $this->url;
	}
	
/**
 * Get the file key
 *
 * @access	public
 * @return	string	The file key
 */
	public function get_key()
	{
		return $this->key;
	}
	
/**
 * Get the file name
 *
 * @access	public
 * @return	string	The file name
 */
	public function get_name()
	{
		return $this->name;
	}
	
/**
 * Get the file size
 *
 * @access	public
 * @return	string	The file size
 */
	public function get_size($format = true)
	{
		$size = null;
		if ($this->exists())
		{
			if (empty($this->size)) $this->size = filesize($this->root);
			
			if ($format === true)
			{
				$sizes = array('o', 'Ko', 'Mo', 'Go', 'To', 'Po', 'Eo', 'Zo', 'Yo');
				$size = (round($this->size/pow(1024, ($i = floor(log($this->size, 1024)))), 1) . ' ' . $sizes[$i]);
			}
			else $size = $this->size;
		}
		return $size;
	}
	
/**
 * Get the file extension
 *
 * @access	public
 * @return	string	The file extension
 */
	public function get_extension()
	{
		if ($this->exists() && empty($this->extension))
		{
			$this->extension = mb_strtolower(mb_substr($this->key, mb_strrpos($this->key, '.') + 1));
		}
		return $this->extension;
	}
	
/**
 * Get the file MIME data
 *
 * @access	public
 * @return	string	The file MIME data
 */
	public function get_mime()
	{
		if ($this->exists() && empty($this->mime))
		{
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			$this->mime = $finfo->file($this->root);
		}
		return $this->mime;
	}
	
/**
 * Get the file MIME type
 *
 * @access	public
 * @return	string	The file MIME type
 */
	public function get_mimeType()
	{
		if ($this->exists() && empty($this->mimeType))
		{
			list($this->mimeType, $subtype) = explode('/', $this->get_mime());
		}
		return $this->mimeType;
	}
	
/**
 * Get the file MIME subtype
 *
 * @access	public
 * @return	string	The file MIME subtype
 */
	public function get_mimeSubtype()
	{
		if ($this->exists() && empty($this->mimeType))
		{
			list($type, $this->mimeSubtype) = explode('/', $this->get_mime());
		}
		return $this->mimeSubtype;
	}
	
/**
 * Get the file creation date
 *
 * @access	public
 * @return	string	The file creation date
 */
	public function get_created()
	{
		if ($this->exists() && empty($this->created))
		{
			$this->created = date('Y-m-d H:i:s', filectime($this->root));
		}
		return $this->created;
	}
	
/**
 * Get the file last update
 *
 * @access	public
 * @return	string	The file last update
 */
	public function get_updated()
	{
		if ($this->exists() && empty($this->updated))
		{
			$this->updated = date('Y-m-d H:i:s', filemtime($this->root));
		}
		return $this->updated;
	}
	
/**
 * Print a file
 *
 * @access	public
 */
	public function __tostring()
	{
		return '<a href="'.$this->get_url().'">'.$this->get_key().'</a>';
	}
}
?>