<?php
/**
 * Classe de manipulation des répertoires
 * 
 * Pour créer, manipuler, déplacer, supprimer les répertoires
 * <pre>
 * $dir = new dir(directory);
 * $dir->get();
 * </pre>
 * 
 * @package		file
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class dir
{
	protected $key;
	protected $root;
	protected $nogood = array('Thumbs.db', '.DS_Store', '.svn', '.', '..');
	public $data;

/**
 * Crée un objet "répertoire" défini par son chemin
 *
 * @param	string	le chemin du répertoire
 * @access	public
 */	
	public function __construct($root)
	{
		$this->root = $root;
		$this->_set_key();
	}
	
/**
 * Charger la clé (nom) du répertoire
 *
 * @access	private
 */	
	private function _set_key()
	{
		$this->key = mb_substr($this->root, mb_strrpos($this->root, '/')+1);
	}

/**
 * Obtenir tout le contenu du répertoire
 *
 * @param	bool	true : charger tout les niveaux d'arborescence. false : charger le premier niveau d'arborescence. False par défaut.
 * @return	array	Le tableau associatif de l'arbo du répertoire
 * @access	public
 */
	public function get($recursive = false)
	{
		$dir = dir($this->root);
		while($entry = $dir->read())
		{
			$type = filetype($this->root.'/'.$entry);
		 	if (!in_array($entry, $this->nogood))
			{
				$path = $this->root.'/'.$entry;
				$obj = ($type === 'dir') ? new dir($path) : new file($path);
				if ($recursive === true && get_class($obj) === __CLASS__) $obj->get($recursive);
				$this->data[$obj->get_key()] = $obj;
			}
		}
		$dir->close();
		
		return $this->data;
	}
	
/**
 * Enregistrer tous les changements
 *
 * @access	private
 */
	private function _save()
	{
		if (!$this->exists($this->root)) mkdir($this->root, 0777, true);
	}
	
/**
 * Copier un répertoire et son contenu
 *
 * @param	string	le chemin de destination
 * @access	public
 */
	public function copy($path)
	{
		$copy = new dir($path);
		$copy->_save();
		$this->get();
		
		foreach ($this->data as $key => $value)
		{
			$copy_path = $path.'/'.$key;
			$value->copy($copy_path);
		}
		unset($copy);
	}

/**
 * Effacer un répertoire et son contenu
 *
 * @access	public
 */
	public function delete()
	{
		$this->get();
		foreach ($this->data as $key => $value)
		{
			$value->delete();
		}
		rmdir($this->root);
	}
	
/**
 * Déplacer un répertoire et son contenu
 *
 * @param	string	le chemin de destination
 * @access	public
 */
	public function move($path)
	{
		$this->copy($path);
		$this->delete();
		$this->root = $path;
		$this->_set_key();
		unset($this->data);
	}

/**
 * Vérifier l'existence d'un répertoire
 *
 * @access	public
 */
	public function exists()
	{
		return is_dir($this->root);
	}
	
/**
 * Obtenir le chemin d'un répertoire
 *
 * @return	string	le chemin du répertoire
 * @access	public
 */
	public function get_root()
	{
		return $this->root;
	}

/**
 * Obtenir le nom du répertoire
 *
 * @return	string	le nom du répertoire
 * @access	public
 */
	public function get_key()
	{
		return $this->key;
	}
}
?>