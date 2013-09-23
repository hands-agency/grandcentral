<?php
/**
 * Classe de manipulation des images
 * 
 * http://stackoverflow.com/questions/11061355/security-threats-with-uploads
 * 
 * @package		file
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class file
{
	protected $key;
	protected $dir;
	protected $url;
	protected $root;
	protected $data;
	protected $size;
	protected $extension;
	protected $mime;
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
		$this->dir = dirname($this->root);
		$this->url = CC_DIR.substr($this->root, strlen(CC_ROOT));
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
 * Remplacer l'intégralité du contenu d'un fichier
 *
 * @param	string	le contenu à ajouter
 * @access	public
 */
	public function set($data)
	{
		$this->data = $data;
	}

/**
 * Sauvegarder un fichier
 *
 * @param	bool	créer le répertoire du fichier si celui-ci n'existe pas. "false" par défaut.
 * @access	public
 */
	public function save($mkdir = false)
	{
		if (!is_dir($this->dir) && $mkdir === true) mkdir($this->dir, 0777, true);
		file_put_contents($this->root, $this->data);
	}
	
/**
 * Copier un fichier
 *
 * @param	string	le chemin de destination
 * @access	public
 */
	public function copy($dir, $key = null)
	{
		if (!is_dir($dir)) mkdir($dir, 0755, true);
		
		if (is_null($key)) $key = $this->key;
		copy($this->root, $dir.'/'.$key);
	}

/**
 * Déplacer un fichier
 *
 * @param	string	le chemin de destination
 * @access	public
 */
	public function move($path)
	{
		$this->copy($path);
		$this->delete();
		$this->_set_var();
	}

/**
 * Supprimer un fichier
 *
 * @access	public
 */
	public function delete()
	{
		if ($this->exists()) unlink($this->root);
	}

/**
 * Vérifier l'existence du fichier
 *
 * @return	bool	true ou false
 * @access	private
 */
	public function exists()
	{
		return is_file($this->root);
	}
	
/**
 * Ajouter du contenu au fichier
 *
 * @param	string	le contenu à ajouter
 * @access	public
 */
	public function combine_string($data)
	{
		$this->data .= $data;
	}
	
/**
 * Ajouter le contenu d'un autre fichier au fichier
 *
 * @param	string	le chemin vers le fichier
 * @access	public
 */
	public function combine_file($path)
	{
		$file = new file($path);
		$this->data .= $file->get();
	}
	
/**
 * Minifier le contenu d'un fichier
 *
 * @param	string	le type de minification souhaitée (js, css ou autre)
 * @access	public
 */
	public function minify($type = null)
	{
		switch ($type) {
			case 'js':
				$this->data = JSMin::minify($this->data);
				break;
			case 'css':
				$this->data = Minify_CSS_Compressor::process($this->data);
				break;
		}
	}
	
/**
 * Obtenir le chemin du répertoire du fichier
 *
 * @return	string	le chmin du répertoire root du fichier
 * @access	private
 */
	public function get_dir()
	{
		return $this->dir;
	}
	
/**
 * Obtenir le chemin du répertoire du fichier
 *
 * @return	string	le chmin du répertoire root du fichier
 * @access	private
 */
	public function get_root()
	{
		return $this->root;
	}
	
/**
 * Obtenir l'url web du fichier
 *
 * @return	string	l'url du fichier
 * @access	private
 */
	public function get_url()
	{
		return $this->url;
	}
	
/**
 * Obtenir le nom du fichier
 *
 * @return	string	le nom du fichier
 * @access	private
 */
	public function get_key()
	{
		return $this->key;
	}
	
/**
 * Get the file size
 *
 * @return	string	le nom du fichier
 * @access	private
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
 * @return	string	le nom du fichier
 * @access	private
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
 * Get the file MIME type
 *
 * @return	string	le nom du fichier
 * @access	private
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
 * Obtenir le nom du fichier
 *
 * @return	string	le nom du fichier
 * @access	private
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
 * Obtenir le nom du fichier
 *
 * @return	string	le nom du fichier
 * @access	private
 */
	public function get_updated()
	{
		if ($this->exists() && empty($this->updated))
		{
			$this->updated = date('Y-m-d H:i:s', filemtime($this->root));
		}
		return $this->updated;
	}
}
?>