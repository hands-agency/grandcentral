<?php
/**
 * Classe abstaire de manipulation des champs
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 * @abstract
 */
abstract class _fields
{
	protected $datatype;
	protected $label;
	protected $descr;
	protected $name;
	protected $value;
	protected $cssclass;
	protected $customdata;
	protected $containerclass = 'field';
	protected $required = false;
	protected $readonly = false;
	protected $disabled = false;
	protected $min;
	protected $max;
	protected $attrs;
	protected $errors;
	protected $errors_message;
	
/**
 * Créer un nouveau champ et le peupler de ses attributs
 *
 * ex :
 * $param = array(
 * 	'label' => 'The title',
 * 	'descr' => 'Put here the short title',
 * 	'value' => 'Home',
 * 	'cssclass' => 'title',
 * 	'placeholder' => 'Give me a title',
 * 	'required' => true,
 * 	'disabled' => false,
 * 	'readonly' => true,
 * 	'min' => 5,
 * 	'max' => 30,
 * 	...
 * );
 * new field_text('title', $param);
 * 
 * @param	string	le nom du champ
 * @param	array	le tableau de paramètres du champ
 * @access	public
 */
	function __construct($name, $attrs = null)
	{
	
		# Fields shouldn't have an idea all the time, but a name, YES
	//	$this->attrs['name'] = $this->attrs['id'] = $this->name = $name;
		$this->attrs['name'] = $this->name = $name;
		if (isset($attrs['key'])) $this->attrs['data-key'] = $attrs['key'];
	
		foreach ((array) $attrs as $key => $value)
		{
			$method = 'set_'.$key;
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}
/**
 * Vérifie la validité de la valeur du champ
 * 
 * @param	mixed	la valeur du champ
 * @return	bool	true ou false
 * @access	public
 */
	function is_valid()
	{
		$valid = true;
		// print '<pre>'.$this->name.' : ';print_r($value);print'</pre>';
		if (true === $this->required && empty($this->value))
		{
			$valid = false;
			$this->_error('required');
		}
		
		return $valid;
	}
/**
 * Charge les erreurs obtenues lors de la validation du champ
 * 
 * @param	string	la clé d'erreur
 * @param	mixed	la valeur ayant amenée l'erreur sur le champ
 * @access	protected
 */
	protected function _error($error_id)
	{
		$this->errors[$error_id]['key'] = (isset($this->errors_message[$error_id])) ? $this->errors_message[$error_id] : $error_id;
		$this->errors[$error_id]['descr'] = constant(strtoupper('FIELD_VALIDATION_ERROR_'.$this->errors[$error_id]['key']));
		$this->errors[$error_id]['value'] = $this->value;
		
		return $this;
	}
/**
 * Affecte un label au champ
 * 
 * @param	string	le label
 * @access	public
 */
	public function set_label($text)
	{
		$this->label = $text;
		return $this;
	}
/**
 * Affecte une description au champ
 * 
 * @param	string	la description
 * @access	public
 */
	public function set_descr($text)
	{
		$this->descr = $text;
		return $this;
	}
/**
 * Affecte un minimum requis au champ
 * 
 * @param	string	le minimum
 * @access	public
 */
	public function set_min($value)
	{
		if (ctype_digit((string)$value) && $value > 0)
		{
			$this->min = $value;
		}
		return $this;
	}
/**
 * Affecte un maximum requis au champ
 * 
 * @param	string	le maximum
 * @access	public
 */
	public function set_max($value)
	{
		if (ctype_digit((string)$value) && $value > 0)
		{
			$this->max = $value;
		}
		
		return $this;
	}
/**
 * Affecte un identifiant html (id) au champ
 * 
 * @param	string	l'id
 * @access	public
 */
	public function set_id($id)
	{
		$this->attrs['id'] = $id;
		return $this;
	}
/**
 * Affecte une valeur au champ
 * 
 * @param	mixed	la valeur
 * @access	public
 */
	public function set_value($text)
	{
		if (!empty($text))
		{
			$this->value = $text;
			$this->attrs['value'] = $this->get_cleaned_value($text);
		}
		return $this;
	}
/**
 * Affecte une ou plusieurs classes css au champ
 * 
 * @param	string	la ou les classes css
 * @access	public
 */
	public function set_cssclass($text)
	{
		if (!empty($text)) $this->attrs['class'] = $text;
		return $this;
	}
/**
 * Affecte un placeholder au champ
 * 
 * @param	string	le placeholder
 * @access	public
 */
	public function set_placeholder($text)
	{
		if (!empty($text)) $this->attrs['placeholder'] = $text;
		return $this;
	}
/**
 * Affecte une série de data personnalisée (format HTML5) au champ
 * 
 * ex :
 * $field = new field_text('title');
 * $field->customdata(array('key' => 'jquery'))
 * 
 * rendu html = <input type="text" name="title" data-key="jquery" />
 * 
 * @param	array	le tableau de données personnalisées à ajouter
 * @access	public
 */
	public function set_customdata($array)
	{
		if (is_array($array))
		{
			foreach ($array as $key => $value)
			{
				$this->attrs['data-'.$key] = $value;
			}
		}
		return $this;
	}
/**
 * Affecte une classe au container du champ (classe css "field" par défaut)
 * 
 * @param	string	la classe du container du champ
 * @access	public
 */
	public function set_containerclass($class)
	{
		$this->containerclass = $class;
		return $this;
	}
/**
 * Déclare le champ comme obligatoire
 * 
 * @param	bool	true (par défaut) ou false
 * @access	public
 */
	public function set_required($bool = true)
	{
		$bool = (bool) $bool;
		if (true === $bool)
		{
			// $this->attrs['required'] = 'required';
			$this->required = true;
		}
		else
		{
			unset($this->attrs['required']);
			$this->required = false;
		}
		return $this;
	}
/**
 * Déclare le champ comme désactivé
 * 
 * @param	bool	true (par défaut) ou false
 * @access	public
 */
	public function set_disabled($bool = true)
	{
		$bool = (bool) $bool;
		if (true === $bool)
		{
			$this->attrs['disabled'] = 'disabled';
		}
		else
		{
			unset($this->attrs['disabled']);
		}
		$this->disabled = $bool;
		return $this;
	}
/**
 * Déclare le champ en lecture seule
 * 
 * @param	bool	true (par défaut) ou false
 * @access	public
 */
	public function set_readonly($bool = true)
	{
		$bool = (bool) $bool;
		if (true === $bool)
		{
			$this->attrs['readonly'] = 'readonly';
		}
		else
		{
			unset($this->attrs['readonly']);
		}
		$this->readonly = $bool;
		return $this;
	}
/**
 * Obtenir le nom du champ
 * 
 * @return	string	le nom du champ
 * @access	public
 */
	public function get_name()
	{
		return $this->name;
	}
/**
 * Obtenir les classes css du champ
 * 
 * @return	string	les classes css du champ
 * @access	public
 */
	public function get_cssclass()
	{
		return $this->attrs['class'];
	}
/**
 * Obtenir la valeur du champ
 * 
 * @return	string	la valeur du champ
 * @access	public
 */
	public function get_value()
	{
		return $this->value;
	}
/**
 * Obtenir le datatype du champ
 * 
 * @return	string	la datatype du champ
 * @access	public
 */
	public function get_datatype()
	{
		return $this->datatype;
	}
/**
 * Obtenir la valeur nettoyée du champ (pour un affichage sécurisé)
 * 
 * @return	string	le nom propre du champ
 * @access	public
 */
	public function get_cleaned_value($value)
	{
		return $value;
	}
/**
 * Obtenir la liste des erreurs soulevées lors de la validation du champ
 * 
 * @return	array	le tableau des erreurs, de leurs contenus et des valeurs responsables de l'erreur
 * @access	public
 */
	function get_error()
	{
		return $this->errors;
	}
/**
 * Obtenir la description du champ
 * 
 * @return	string	la description du champ
 * @access	public
 */
	function get_descr()
	{
		return $this->descr;
	}
/**
 * Obtenir le label du champ
 * 
 * @return	string	le label du champ
 * @access	public
 */
	function get_label()
	{
		return $this->label;
	}
/**
 * Obtenir le type de champ
 * 
 * @return	string	le type du champ
 * @access	public
 */
	function get_type()
	{
		$class = get_called_class();
		return substr($class, 6);
	}
	
/**
 * Obtenir la clef du champ
 * 
 * @return	string	la clef du champ
 * @access	public
 */
	function get_key()
	{
		if (isset($this->attrs['data-key'])) return $this->attrs['data-key'] ; else return null;
	}
	
/**
 * Obtenir la liste de tous les attributs du champ
 * 
 * @return	array	le tableau des attributs du champ
 * @access	public
 */
	public function get_attr($attr = null)
	{
		if (!empty($attr))
		{
			if (isset($this->$attr)) return $this->$attr;
			else if (isset($this->attr[$attr])) return $this->attr[$attr];
		}
		else
		{
			$reflection = new ReflectionClass($this);
			$tmp = $reflection->getProperties();
			foreach ($tmp as $attr)
			{
				$attrs[$attr->getName()]= $this->{$attr->getName()};
			}
			return $attrs;
		}
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
		
		$properties['key'] = array(
			'label' => 'key',
			'type' => 'text',
			'required' => true
		);
		$properties['label'] = 'text';
		$properties['descr'] = 'textarea';
		$properties['required'] = 'bool';
		$properties['disabled'] = 'bool';
		$properties['readonly'] = 'bool';
		$properties['placeholder'] = 'text';
		$properties['min'] = 'number';
		$properties['max'] = 'number';
		$properties['customdata'] = 'array';
		
		return $properties;
	}
/**
 * Know whether is field is required or not
 * 
 * @return	string	la valeur du champ
 * @access	public
 */
	public function is_required()
	{
		return $this->required;
	}
/**
 * Construit le code html du champ
 * 
 * Par défaut la méthode __toString va chercher un template dans /field/default/<nom du champ>
 * 
 * @return	string	le html du champ
 * @access	public
 */
	public function __tostring()
	{
	//	label
		$label = '';
		if (!empty($this->label))
		{
			$label = '<label for="'.$this->attrs['name'].'">'.$this->label.'</label>';
		}
	//	template
		$field = substr(get_called_class(), 6);
		$html = new html($this, 'default', $field);
	//	champ caché pour atteindre l'édition
		// $hidden = '<input type="hidden" name="'.$this->attrs['name'].'" id="'.$this->attrs['name'].'" disabled="disabled" />';
	//	affichage
		// return $hidden.$label.'<span class="'.$this->containerclass.'">'.$html->__tostring().'</span>';
		return $label.'<span class="'.$this->containerclass.'">'.$html->__tostring().'</span>';
	}
}
?>