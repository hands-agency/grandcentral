<?php
/**
 * La classe de documentation automatique
 *
 * @package  doc
 * @author	Sylvain Frigui <sf@hands.agency>
 * @link		http://grandcentral.fr
 */
class doc
{
	private $reflection;
	private $type;
	public $data;
	
/**
 * Détermine le type de l'expression passée et prépare la documentation en conséquence
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	public function __construct($expression)
	{
		if ((is_object($expression) && get_class($expression)) || (is_string($expression) && registry::get(registry::class_index, $expression)))
		{
			$this->_prepare_class($expression);
		}
		elseif (mb_strpos($expression, '::'))
		{
			list($class, $method) = explode('::', $expression);
			if (method_exists($class, $method) )
			{
				$this->_prepare_method($class, $method);
			}
		}
		elseif (is_string($expression) && function_exists($expression))
		{
			$this->_prepare_function($expression);
		}
	}
	
/**
 * Affiche la partie de la documentation désirée
 *
 * @param	mixed	un objet php, le nom d'une classe, d'une fonction, d'une méthode
 * @access	public
 */
	public static function show($expression)
	{
		
		$obj = new doc($expression);
	}
/**
 * Obtenir le genre de l'objet documenté
 *
 * @return	string	le genre
 * @access	public
 */
	public function get_type()
	{
		return $this->type;
	}
/**
 * Préparer la documentation d'une classe
 *
 * @param	mixed  le nom de la classe ou l'objet php
 * @access	private
 */
	private function _prepare_class($class)
	{
		$this->type = 'class';
		$this->reflection = new ReflectionClass($class);
		$this->data = $this->_parse($this->reflection);
		$methods = $this->reflection->getMethods();
		$this->data['property'] = $this->reflection->getDefaultProperties();
		$this->data['constant'] = $this->reflection->getConstants();
		if (get_parent_class($this->reflection->getName()) !== false)
		{
			$parent = $this->reflection->getParentClass();
			$this->data['parent'] = $parent->getName();
		}
		$this->data['interface'] = $this->reflection->getInterfaceNames();
		if (empty($this->data['interface'])) unset($this->data['interface']);
		
		// print '<pre>';print_r($methods);print'</pre>';
		$this->data['method'] = new bunch();
		foreach ($methods as $key => $method)
		{
			$data = $this->_parse($method);
			$data['key'] = $this->reflection->name.'::'.$data['key'];
			$this->data['method'][] = $data;
		}
		// print '<pre>';print_r($this->data['method']);print'</pre>';
		$this->data['method']->order('key');
	}
	
/**
 * Préparer la documentation d'une methode de classe
 *
 * @param	mixed	le nom de la classe ou l'objet php
 * @param	string	le nom de la méthode
 * @access	private
 */
	private function _prepare_method($class, $method)
	{
		$this->type = 'method';
		$this->reflection = new ReflectionMethod($class, $method);
		$this->data = $this->_parse($this->reflection);
		$this->data['class'] = $this->reflection->class;
		$this->data['key'] = $this->reflection->class.'::'.$this->data['key'];
	}
	
/**
 * Préparer la documentation d'une fonction
 *
 * @param	string	le nom de la fonction
 * @access	private
 */
	private function _prepare_function($function)
	{
		$this->type = 'function';
		$this->reflection = new ReflectionFunction($function);
		$this->data = $this->_parse($this->reflection);
	}
	
/**
 * Analyser les données préparées et construit un tableau d'extraction des données 
 *
 * @param	reflection	la reflection de la classe, la méthode ou la fonction
 * @return	array		le tableau des données analysées
 * @access	private
 */
	private function _parse($reflection)
	{
		$comment = $reflection->getDocComment();
		
		preg_match_all('#^\s*\*\/? ?(.*)#m', $comment, $lines);
		
		$data['key'] = $reflection->getName();
		$data['descr'] = null;
		$data['file'] = $reflection->getFileName();
		$data['app'] = $this->_get_app();
		$data['line']['start'] = $reflection->getStartLine();
		$data['line']['end'] = $reflection->getEndLine();
		
		foreach ($lines[1] as $line)
		{
			$line = trim($line);
			if (mb_strpos($line, '@') === 0)
			{
				preg_match_all("/@([a-z]*)[\s]*(.*)/", $line, $tmp);
				// if (!isset($tmp[1][0])) {
				// 					print '<pre>'.$data['key'].' : ';print_r($line);print'</pre>';
				// 				}
				$data[$tmp[1][0]][] = $tmp[2][0];
			}
			else
			{
				$data['descr'] .= str_replace(array('&lt;pre&gt;', '&lt;/pre&gt;'), array('<pre>', '</pre>'), htmlspecialchars($line)).PHP_EOL;
				// $data['descr'] .= $line;
			}
		}
		
	//	paramètres
		if(is_a($reflection, 'ReflectionFunction') || is_a($reflection, 'ReflectionMethod'))
		{
		//	ré-écriture des paramètres
			if (isset($data['param']))
			{
				$comment_params = $data['param'];
				unset($data['param']);
			}
			$params = $reflection->getParameters();
			foreach ($params as $key => $param)
			{
				$name = '';
				if($param->isPassedByReference()) $name .= '&';
				if ($param->isOptional())
				{ 
					$name .= '[' . $param->getName();
					if($param->isDefaultValueAvailable())
					{
						$name .= ' = ';
						$default = $param->getDefaultValue();
						if ($default === false) $default = 'false';
						elseif ($default === true) $default = 'true';
						elseif ($default === null) $default = 'null';
						if(empty($default)) $name .= '""';
						else if (is_string($default)) $name .= $default;
						else if (is_array($default))
						{
							foreach ($default as $value) $name .= $value;
						}
					}
					$name .= ']';
				}
				else $name .= $param->getName();
				$data['param'][$key]['name'] = $name;
			//	récupération des informations des paramètres dans le commentaire
				if (isset($comment_params[$key]))
				{
					preg_match("/([a-z]*)[\s]+(.*)/", $comment_params[$key], $tmp);
					if (!empty($tmp))
					{
						$data['param'][$key]['type'] = $tmp[1];
						$data['param'][$key]['descr'] = $tmp[2];
					}
				}
			}
		}
		return $data;
	}

/**
 * obtenir l'app de la classe, la méthode ou la fonction appelé
 *
 * @return	string		la clef de l'app contenant le code documenté
 * @access	private
 */
	private function _get_app()
	{
		if (!isset($this->data['file']) && empty($this->data['file']))
		{
			$this->data['file'] = $this->reflection->getFileName();
		}
		return mb_substr($this->data['file'], mb_strlen(ADMIN_ROOT) + 1, mb_strpos($this->data['file'], '/', mb_strlen(ADMIN_ROOT) + 1) - mb_strlen(ADMIN_ROOT) - 1);
	}	
	
/**
 * Obtenir la liste des fonctions déclarées par Grand Central
 *
 * @return	array		le tableau des fonctions
 * @access	public
 */
	public function get_defined_functions()
	{
		return get_defined_functions()['user'];
	}
}
?>