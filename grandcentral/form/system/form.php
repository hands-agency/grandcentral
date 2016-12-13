<?php
/**
 * Classe de construction de formulaires html
 * http://www.siteduzero.com/informatique/tutoriels/votre-site-php-presque-complet-architecture-mvc-et-bonnes-pratiques/gestion-des-formulaires-avec-la-classe-form
 *
 * @package		form
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class form
{
	public $attrs = array(
		'id' => null,
		'class' => null,
		'action' => null,
		'method' => 'post',
		'enctype' => 'application/x-www-form-urlencoded',
		'accept-charset' => 'utf-8',
	);
	protected $template = 'form';
	protected $fields = array();
	protected $hidden_fields = array();
	protected $fieldsets = array(
		array('fields' => array())
	);
	private static $instances = array();
/**
 * Créer un nouveau formulaire en fonction des paramètres passés
 *
 * ex :
 * $param = array(
 * 	'id' => 'test',
 * 	'action' => 'http://www.domain.com/routine.php',
 * 	'method' => 'get',
 * 	'enctype' => 'multipart/form-data',
 * );
 * $form = new form('inscription');
 *
 * @param	string	la clé du formulaire
 * @access	public
 */
	public function __construct($params = array())
	{
		foreach ($params as $param => $value)
		{
		//	Set accepted attributes
			$method = 'set_'.$param;
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		//	Set data-
			else if (substr($param, 0, 5) == 'data-')
			{
				$this->set_data(substr($param, 5), $value);
			}
		}
	}
/**
 * Ajouter un champ au formulaire
 *
 * @param	string	le type de champ (text, number, select, ...)
 * @param	string	le nom du champ
 * @param	array	le tableau de paramètres du champ
 * @access	public
 */
	public function set_field($field, $name, $param = null)
	{
		$field = 'field'.ucfirst($field);
		$object = new $field($name, $param);

		if ($field == 'fieldHidden')
		{
			$this->hidden_fields[] = $name;
		}
		else
		{
			$this->fieldsets[count($this->fieldsets) - 1]['fields'][] = $name;
		}
		$this->fields[$name] = $object;
	}
/**
 * Ajouter un nouveau fieldset au formulaire
 *
 * ex :
 * $form = new form('inscription');
 * $param = array(
 * 	'key' => 'coord',
 * 	'title' => 'Mes coordonnées',
 * 	'descr' => 'Ajouter ici la liste de vos coordonnées'
 *	'class' => 'green'
 * );
 * $form->set_fieldset($param);
 *
 *
 * @param	array	le tableau de paramètres du fieldset
 * @access	public
 */
	public function set_fieldset($param = null)
	{
		if (empty($this->fields))
		{
			$this->fieldsets[0] = $param;
		}
		else
		{
			$this->fieldsets[] = $param;
		}
	}
/**
 * Change la page de post visée par le formulaire
 *
 * @param	string	le nom de la page de post à éxécuter
 * @access	public
 */
	public function set_id($id)
	{
		$this->attrs['id'] = $id;
		self::$instances[] = $id;
		return $this;
	}
/**
 * Change la page de post visée par le formulaire
 *
 * @param	string	le nom de la page de post à éxécuter
 * @access	public
 */
	public function set_class($class)
	{
		$this->attrs['class'] = $class;
		return $this;
	}
/**
 * Change la page de post visée par le formulaire
 *
 * @param	string	le nom de la page de post à éxécuter
 * @access	public
 */
	public function set_action($action)
	{
		$action = (is_a($action, 'attrUrl') && !$action->is_empty()) ? $action->__tostring() : $action;
		$this->attrs['action'] = $action;
		return $this;
	}
/**
 * Get the action of a form
 *
 * @access	public
 */
	public function get_action()
	{
		return $this->attrs['action'];
	}
/**
 * Change une valeur de data
 *
 * @param	string	le suffixe de l'attribut data-suffix
 * @param	string	la data à stocker
 * @access	public
 */
	public function set_data($suffix, $data)
	{
		$this->attrs['data-'.$suffix] = $data;
		return $this;
	}
/**
 * Change l'attribut target du formulaire
 *
 * @param	string	le nom de la cible
 * @access	public
 */
	public function set_target($target)
	{
		$this->attrs['target'] = $target;
		return $this;
	}
/**
 * Change la méthode d'encryption des données
 *
 * @param	string	null, multipart/form-data ou application/x-www-form-urlencoded
 * @access	public
 */
	public function set_enctype($enctype)
	{
		$enctype = (in_array($enctype, array('application/x-www-form-urlencoded', 'multipart/form-data'))) ? $enctype : 'application/x-www-form-urlencoded';
		$this->attrs['enctype'] = $enctype;
		return $this;
	}
/**
 * Obtenir la chaine d'attribut html du formaulaire courant
 *
 * @return	string	la chaine d'attribut html du formulaire
 * @access	public
 */
	public function get_attrs()
	{
		$attrs = array();
		foreach ($this->attrs as $key => $attr)
		{
			if (!empty($attr)) $attrs[] = $key.'="'.$attr.'"';
		}
		return implode(' ', $attrs);
	}
/**
 * Change le template du formulaire (template "form" par défaut)
 *
 * @param	string	le nom du template
 * @access	public
 */
	public function set_template($template)
	{
		if (!empty($template)) $this->template = $template;
		return $this;
	}
/**
 * Obtenir le template du formulaire
 *
 * @return	string	le thème
 * @access	public
 */
	public function get_template()
	{
		return $this->template;
	}
/**
 * Vérifie la validité de valeurs de tous les champs du formulaire
 *
 * @return	bool	true si les champs sont valides, false sinon
 * @access	public
 */
	public function is_valid()
	{
		$values = ($this->attrs['method'] == 'post') ? $_POST : $_GET;

		foreach ($this->fields as $key => $field)
		{
			if (!isset($values[$key])) $values[$key] = null;
			if (!$field->is_valid($values[$key])) return false;
		}
		// print '<pre>';print_r($validation);print'</pre>';
		return true;
	}
/**
 * Retourne la liste des erreurs rencontrées lors de la validation
 *
 * @return	array 	le tableau des erreurs rencontrées
 * @access	public
 */
	public function get_errors()
	{
		return $errors;
	}
/**
 * Retourne la liste des champs cachés
 *
 * @return	array 	le tableau des erreurs rencontrées
 * @access	public
 */
	public function get_fields()
	{
		return $this->fields;
	}
/**
 * Retourne la liste des champs cachés
 *
 * @return	array 	le tableau des erreurs rencontrées
 * @access	public
 */
	public function get_field($name)
	{
		return $this->fields[$name];
	}
/**
 * Retourne la liste des champs cachés
 *
 * @return	array 	le tableau des erreurs rencontrées
 * @access	public
 */
	public function delete_field($name)
	{
		unset($this->fields[$name]);

		foreach ($this->fieldsets as $key => $fieldset)
		{
			$index = array_search($name, $fieldset['fields']);
			if ($index !== false)
			{
				unset($this->fieldsets[$key]['fields'][$index]);
			}
		}
	}
/**
 * Retourne la liste des champs cachés
 *
 * @return	array 	le tableau des erreurs rencontrées
 * @access	public
 */
	public function get_hiddens()
	{
		return $this->hidden_fields;
	}
/**
 * Retourne la liste des champs cachés
 *
 * @return	array 	le tableau des erreurs rencontrées
 * @access	public
 */
	public function get_fieldsets()
	{
		return $this->fieldsets;
	}
/**
 * Retourne le html du formulaire définit par son theme et son template
 *
 * @return	string	le html du formulaire
 * @access	public
 */
	public function __tostring()
	{
		$param['form'] = $this;
		$html = app('form', $this->template, $param);
		return $html->__tostring();
	}
/**
 * Retourne le tableau des champs disponibles dans le système
 *
 * @return	array	le tableau des champs disponibles
 * @access	public
 * @static
 */
	public static function get_declared_fields($datatype = null)
	{
		$classes = array_keys(registry::get(registry::class_index));
		sort($classes);
		// print '<pre>';print_r($classes);print'</pre>';
		foreach ($classes as $class)
		{
			if (mb_strpos($class, 'field') !== false)
			{
				$fields[] = substr($class, 6);
				if (!empty($datatype))
				{
					$reflection = new ReflectionClass($class);
					$properties = $reflection->getDefaultProperties();
					if ((is_array($properties['datatype'])  && !in_array($datatype, $properties['datatype'])) || $properties['datatype'] === false)
					{
						array_pop($fields);
					}
				}
			}
		}
		return $fields;
	}
}
?>
