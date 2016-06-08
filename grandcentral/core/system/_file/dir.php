<?php
/**
 * Directory handling class
 *
 * <pre>
 * // Get the content of a directory
 * $dir = new dir('/path/to/dir');
 * $dir->get();
 * </pre>
 *
 * @package		file
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class dir implements Iterator
{
	protected $key;
	protected $root;
	protected static $nogood = array('Thumbs.db', '.DS_Store', '.svn', '.', '..');
	public $data = array();

/**
 * Instantiate a directory defined by its root
 *
 * @param	string	The path to the directory
 * @access	public
 */
	public function __construct($root)
	{
		$this->root = $root;
		$this->_set_key();
	}

/**
 * Change the key (the name) of the directory
 *
 * @access	private
 */
	private function _set_key()
	{
		$this->key = mb_substr($this->root, mb_strrpos($this->root, '/')+1);
	}

/**
 * Get the content of a directory
 * <pre>
 * // Get the content of a directory
 * $dir = new dir('/path/to/dir');
 * $dir->get();
 * // Get the content of a directory and its subdirectories
 * $dir = new dir('/path/to/dir');
 * $dir->get(true);
 * </pre>
 * @param	bool	Retrieve sub directories to. Default: false
 * @return	array	The directory listing
 * @access	public
 */
	public function get($recursive = false)
	{
		if (is_dir($this->root)) $dir = dir($this->root);
		if (isset($dir) && !empty($dir))
		{
			while($entry = $dir->read())
			{
				$type = filetype($this->root.'/'.$entry);
			 	if (!in_array($entry, self::$nogood))
				{
					$path = $this->root.'/'.$entry;
					$obj = ($type === 'dir') ? new dir($path) : new file($path);
					if ($recursive === true && get_class($obj) === __CLASS__) $obj->get($recursive);
					$this->data[$obj->get_key()] = $obj;
				}
			}
			$dir->close();
		}

		return $this->data;
	}

/**
 * Save all changes
 *
 * @access	public
 */
	public function save()
	{
		if (!$this->exists($this->root)) mkdir($this->root, 0775, true);
	}

/**
 * Filter the listing of a directory using keywords
 *
 * <pre>
 * // Get the files in this directory having "blue" in their name
 * $dir = new dir('/path/to/dir');
 * $dir->get()->filter('blue');
 * </pre>
 * @param	string	The filter
 * @return	array	The directory listing
 * @access	public
 */
	public function filter($filter)
	{
		$filteredData = array();
		foreach ($this->data as $key => $value)
		{
			if (strstr($key, $filter)) $filteredData[$key] = $value;
		}
		$this->data = $filteredData;
	}

/**
 * Sort a directory listing by date
 * <pre>
 * // Sort a directory listing by date
 * $dir = new dir('/path/to/dir');
 * $dir->get()->sortbydate();
 * </pre>
 * @access	public
 */
	public function sortbydate()
	{
		$t = array();
	//	Get files timestamps
		foreach ($this->data as $key => $file)
		{
			$t[$key] = filemtime($file->get_root());
		}
	//	Sort timestamps
		natcasesort($t);
		$keys = array_reverse(array_keys($t));

	//	Reorder
		$data = array();
		foreach ($keys as $index)
		{
			$data[$index] = $this->data[$index];
		}

	//	Overwrite data
		$this->data = $data;
	}

/**
 * Copy a directory and its content
 * <pre>
 * // Copy a directory and its content
 * $dir = new dir('/path/to/dir');
 * $dir->get()->copy('/new/path/of/dir);
 * </pre>
 * @param	string	The destination path
 * @access	public
 */
	public function copy($path)
	{
		$copy = new dir($path);
		$copy->save();
		$this->get();

		foreach ($this->data as $key => $value)
		{
			$copy_path = $path.'/'.$key;
			$value->copy($copy_path);
		}
		unset($copy);
	}

/**
 * Permanently delete a directory and its content
 * <pre>
 * // Permanently delete a directory and its content
 * $dir = new dir('/path/to/dir');
 * $dir->get()->delete();
 * </pre>
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
 * Move a directory and its content
 * <pre>
 * // Move a directory and its content
 * $dir = new dir('/path/to/dir');
 * $dir->get()->move('/path/of/dir/copy');
 * </pre>
 * @param	string	The destination path
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
 * Checks if directory exists
 * <pre>
 * // Check if directory exists
 * $dir = new dir('/path/to/dir');
 * if ($dir->exists()) echo 'I exist!';
 * </pre>
 * @access	public
 */
	public function exists()
	{
		return is_dir($this->root);
	}

/**
 * Get the root of a directory
 * <pre>
 * // Get the root of a directory
 * $dir = new dir('/path/to/dir');
 * echo $dir->get_root();
 * </pre>
 * @return	string	The root of a directory
 * @access	public
 */
	public function get_root()
	{
		return $this->root;
	}

/**
 * Get the name of the directory
 * <pre>
 * // Get the name of the directory
 * $dir = new dir('/path/to/dir');
 * echo $dir->get_key();
 * </pre>
 * @return	string	The name of the directory
 * @access	public
 */
	public function get_key()
	{
		return $this->key;
	}

/**
 * Edit the rights for a directory and all his descendants
 * http://php.net/manual/fr/function.chmod.php
 * @param		int 	mode (0755 by default)
 * @return	string
 * @access	public
 */
	public function chmod($mode = 0755)
	{
		foreach ($this->get() as $value)
		{
			chmod($value->get_root(), $mode);
		}
		return $this;
	}

//	Iterator
	function rewind()
	{
		reset($this->data);
	}
	function current()
	{
		return current($this->data);
	}
	function key() {
		return key($this->data);
	}
	function next()
	{
		next($this->data);
	}
	function valid()
	{
	    return key($this->data) !== null;
	}
}
?>
