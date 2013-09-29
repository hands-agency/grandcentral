<?php
/**
 * Classe abstaire de manipulation des champs de selection
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 * @abstract
 */
abstract class _fieldsSelector extends _fields
{
	protected $datatype = array('rel, string');
	protected $values;
	protected $valuestype = 'function';
	// protected $irel = false;
/**
 * Affecte une valeur au champ. Les valeurs des sélecteurs peuvent être des dérivés de _item ou des string de type page_1
 * 
 * @param	mixed	un objet ou un tag d'objet (ex : page_1)
 * @access	public
 */
	public function set_value($value)
	{
		if (is_a($value, '_items'))
		{
			$value = $value->get_nickname();
		}
		elseif (is_array($value))
		{
			$value = $value;
		}
		$this->value = $value;
		return $this;
	}
/**
 * Affecte le type des values du selecteur. Les types sont : bunch, array, function, method
 * 
 * @param	string	bunch ou array ou function ou method
 * @access	public
 */
	public function set_valuestype($type)
	{
		$this->valuestype = $type;
		return $this;
	}
/**
 * Définit les choix possible dans le sélecteur
 * 
 * @param	mixed	un tableau associatif, le nom d'une fonction, d'une méthode ou la description d'un bunch
 * @access	public
 */
	public function set_values($values)
	{
		// print '<pre>';print_r($values);print'</pre>';
		$this->values = $values;
		return $this;
	}
/**
 * Prépare la liste des valeurs en fonction du type passé
 * 
 * @return	array 	la liste des valeurs traitées sous forme de tableau
 * @access	public
 */
	public function prepare_values()
	{
		if (empty($this->valuestype))
		{
			trigger_error('Empty valuestype in field '.$this->name, E_USER_NOTICE);
			return array();
		}
		if (empty($this->values))
		{
			trigger_error('Empty values in field '.$this->name, E_USER_NOTICE);
			return array();
		}
		switch ($this->valuestype)
		{
			case 'array':
				$values = $this->_prepare_values_array();
				break;
			case 'bunch':
				$values = $this->_prepare_values_bunch();
				break;
			case 'function':
				$values = $this->_prepare_values_function();
				break;
			case 'method':
				$values = $this->_prepare_values_method();
				break;
			default:
				$values = array();
				break;
		}
		return $values;
	}
/**
 * Prépare la liste des valeurs de type array
 * 
 * @return	array 	la liste des valeurs traitées sous forme de tableau
 * @access	protected
 */
	protected function _prepare_values_array()
	{
		foreach ($this->values as $key => $value)
		{
			if (!is_string($key)) $key = $value;
		//	Prepare id, title and descr for values
			$id = $key;
			$title = $value;
			$descr = null;
		//	BAM
			$values[] = array('id' => $id, 'title' => $title, 'descr' => $descr);
		}
		
		return $values;
	}
/**
 * Prépare la liste des valeurs de type bunch
 * 
 * @return	array 	la liste des valeurs traitées sous forme de tableau
 * @access	protected
 */
	protected function _prepare_values_bunch()
	{
	//	Some vars
		$values = '';
	//	création du bunch
		$env = (env == 'admin' && !empty($_SESSION['pref']['handled_env'])) ? $_SESSION['pref']['handled_env'] : env;
		$bunch = new bunch(null, null, $env);
	//	on formate les données entrées
		switch (true)
		{
			case is_string($this->values):
				$this->values = array(array('item' => $this->values));
				break;
			case isset($this->values['item']):
				$tmp = $this->values;
				$this->values = null;
				$this->values = array($tmp);
				break;
		}
	//	analyse des données reçues
		$countTable = 0;
		foreach ($this->values as $value)
		{
			$table = $value['item'];
			$params = (isset($value['property'])) ? $value['property'] : null;
			// print'<pre>';print_r($value);print'</pre>';
			$bunch->get($table, $params);
			$countTable++;
		}
	//	création de la liste des valeurs
		foreach ($bunch as $value)
		{
			$table = $value->get_table();
		//	Prepare id, title and descr for values
			$id = $table.'_'.$value['id'];
			$title = (isset($value['title']) && !empty($value['title'])) ? $value['title'] : $value['key'];
			$descr = (isset($value['descr']) && !empty($value['descr'])) ? $value['descr'] : null;
		//	BAM
			if ($countTable > 1) $values[$table][] = array('id' => $id, 'title' => $title, 'descr' => $descr);
			else $values[] = array('id' => $id, 'title' => $title, 'descr' => $descr);
		}
		return $values;
	}
/**
 * Prépare la liste des valeurs de type function
 * 
 * @return	array 	la liste des valeurs traitées sous forme de tableau
 * @access	protected
 */
	protected function _prepare_values_function()
	{
		$values = '';
		if (!is_array($this->values))
		{
			$function = array(
				$this->values,
				array()
			);
		}
		else $function = $this->values;
		if (function_exists($function[0]))
		{
			$values = call_user_func_array($function[0], $function[1]);
		}
		
		return $values;
	}
/**
 * Prépare la liste des valeurs de type method
 * 
 * @return	array 	la liste des valeurs traitées sous forme de tableau
 * @access	protected
 */
	protected function _prepare_values_method()
	{
		$values = '';
		if (!is_array($this->values))
		{
			$method = array(
				$this->values,
				array()
			);
		}
		else $method = $this->values;
		list($method['class'], $method['name']) = explode('::', $method[0]);
		if (method_exists($method['class'], $method['name']))
		{
			$values = call_user_func_array(array($method['class'], $method['name']), $method[1]);
		}
		
		return $values;
	}
/**
 * Obtenir la définition des propriétés du champ
 * 
 * @return	array 	la liste des propriétés et leurs définitions
 * @access	public
 * @static
 */
	public static function get_defined_properties()
	{
		$properties = parent::get_defined_properties();
		$properties['valuestype'] = array(
			'type' => 'select',
			'valuestype' => 'array',
			'values' => array('array', 'bunch', 'function'),
			'value' => 'array',
		);
		$properties['values'] = 'text';
		$properties['irel'] = 'text';
		
		return $properties;
	}
	
/**
 * Vérifie la validité de la valeur du champ / TODO
 * 
 * @param	mixed	la valeur du champ
 * @return	bool	true ou false
 * @access	public
 */
	function is_valid()
	{
		$valid = true;
		
		return $valid;
	}
}
?>