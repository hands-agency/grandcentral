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
class itemForm extends _items
{
	private $action;
	
/**
 * Vérifie si les champs du formulaire sont correctement remplis.
 * Retourne true s'ils sont tous valide, sinon retourne un tableau d'erreurs
 *
 * @param	string	la clef du champ
 * @param	string	la clef du paramètre visé
 * @param	mixed	la valeur du paramètre
 * @access	public
 */
	public function populate_with_item(_items $item)
	{
		foreach ($this['field'] as $id => $field)
		{
			if (isset($field['key']) && isset($item[$field['key']]))
			{
				$field['value'] = $item[$field['key']]->get();
				$this['field'][$id] = $field;
			}
		}
		return $this;
	}
	
/**
 * Vérifie si les champs du formulaire sont correctement remplis.
 * Retourne true s'ils sont tous valide, sinon retourne un tableau d'erreurs
 *
 * @param	string	la clef du champ
 * @param	string	la clef du paramètre visé
 * @param	mixed	la valeur du paramètre
 * @access	public
 */
	public function validate($datas)
	{
		// print'<pre>';print_r($datas);print'</pre>';
	//	on peuple le form avec les valeurs de data
		foreach ($this['field'] as $id => $field)
		{
			
			if (isset($field['key']) && isset($datas[$field['key']]))
			{
				$field['value'] = $datas[$field['key']];
				$this['field'][$id] = $field;
			}
		}
	//	on récupère le form html pour générer les champs
		$form = $this->prepare();
		// print'<pre>';print_r($form->get_field('user[firstname]'));print'</pre>';
	//	on teste chaque champ
		foreach ($form->get_fields() as $id => $field)
		{
			// print'<pre>';print_r($field);print'</pre>';
			$return[] = array(
				'key' => $field->get_name(),
				'valid' => $field->is_valid(),
				'error' => $field->get_error()
			);
		}
		return $return;
	}
/**
 * Ajoute / modifie les paramètres des champs
 *
 * @param	string	la clef du champ
 * @param	string	la clef du paramètre visé
 * @param	mixed	la valeur du paramètre
 * @access	public
 */
	public function set_fieldparam($field, $param, $value)
	{
		$this->data['field'][$field][$param] = $value;
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
		$this->action = $action;
		return $this;
	}
/**
 * Retourne un objet de la classe form correspondant à l'itemForm
 * 
 * @return	form	un objet de la classe form
 * @access	public
 */
	public function prepare()
	{
	//	Default action
		if (empty($this->action)) $this->action = i('page', $this['action']->get(), $this->get_env())['url'];
		
	//	paramètres du formulaire HTML
		$params = array(
			'data-item' => 'form_'.$this['id'],
			'data-key' => $this['key'],
			'action' => $this->action,
			'method' => $this['method'],
			'enctype' => $this['enctype'],
			'target' => $this['target'],
			'template' => $this['template'],
		);
	//	instanciation du formulaire
		$form = new form($params);
	//	ajout des champs
		if (isset($this['field']))
		{
			foreach ($this['field'] as $data)
			{
				if (!isset($data['type']))
				{
					trigger_error('Empty type in form '.$this['key'].'.', E_USER_WARNING);
				}
				else
				{
					if ($data['type'] == 'fieldset')
					{
						$form->set_fieldset($data);
					}
					else
					{
						if (mb_strstr($data['key'], '['))
						{
							$form->set_field($data['type'], $this['key'].$data['key'], $data);
						}
						else
						{
							$form->set_field($data['type'], $this['key'].'['.$data['key'].']', $data);
						}
					}
				}
			}
		}
	//	affichage
		return $form;
	}
/**
 * Retourne le html du formulaire définit par son theme et son template
 * 
 * @return	string	le html du formulaire
 * @access	public
 */
	public function __tostring()
	{
		$form = $this->prepare();
	//	affichage
		return $form->__tostring();
	}
}

?>