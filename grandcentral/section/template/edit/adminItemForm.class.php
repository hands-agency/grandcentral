<?php
/**
 * Classe de construction de formulaires html
 * http://www.siteduzero.com/informatique/tutoriels/votre-site-php-presque-complet-architecture-mvc-et-bonnes-pratiques/gestion-des-formulaires-avec-la-classe-form
 * 
 * @package		form
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class adminItemForm
{
	private $table;
	private $form;
	private $item;
/**
 * Class constructor
 *
 * @param	string  admin ou site
 * @param	string 	la table de l'item à éditer
 * @param	mixed	l'identifiant ou la clé de l'objet à éditer
 * @access	public
 */
	public function __construct($env, $table, $key = null)
	{
		$this->env = $env;
		$this->table = $table;
	//	recherche du formulaire
		$this->form = cc('form', $env.'_'.$table, 'admin');
		$this->form['key'] = $env.'_'.$table;
		$this->form['title'] = $env.'_'.$table;
		$this->form['theme'] = 'default';
		$this->form['template'] = 'form';
		$this->form['action'] = 'item';
		$this->form['method'] = 'post';
		$this->form['status'] = 'live';
	//	recherche de l'objet
		$this->item = cc($table, $key, $env);
	}
/**
 * Mettre en conformité le formulaire et la structure
 *
 * @access	public
 */
	private function _conform_to_structure()
	{
	//	création du formulaire si celui-ci existe
		if (!$this->form->exists())
		{
			$this->_create_form();
		}
	//	modification du formaulaire seulement si la structure de l'objet a été modifiée
		else
		{
 
		}
	}
/**
 * Mettre à jour le formulaire à partir des éléments de la structure
 *
 * @access	public
 */
	private function _create_form()
	{
	//	structure de référence
		$attrs = registry::get($this->env, registry::structure_index, $this->table, 'attr');;
	//	mise en conformité des attributs
		foreach ($attrs as $key => $attr)
		{
			if (isset($attr['key'])) $fields[$attr['key']] = $this->_attr_to_field($attr);
		}
		
		$this->form['field'] = $fields;
		
		$this->form['field']['table'] = array(
			'type' => 'hidden',
			'key' => 'table',
			'value' => $this->table
		);
		
		// $this->form->save();
		// print'<pre>';print_r($fields);print'</pre>';
	}
/**
 * Mettre à jour le formulaire à partir des éléments de la structure
 *
 * @access	public
 */
	private function _update_form()
	{
		$this->_create_form();
	}
	
/**
 * Déduire le type de champ à afficher en fonction d'un attribut de structure
 *
 * @param	array 	un attribut de structure
 * @access	public
 */
	private function _attr_to_field($attr)
	{
		print'<pre>';print_r($attr);print'</pre>';
	// //	key, label
	// 	$field['key'] = $attr['key'];
	// 	$field['label'] = (isset($attr['title']) && !empty($attr['title'])) ? $attr['title'] : $attr['key'];
	// //	types
	// 	switch (true)
	// 	{
	// 	//	string
	// 		case $attr['type'] == 'string':
	// 		//	particularités
	// 			switch (true)
	// 			{
	// 				case $attr['max'] <= 255:
	// 					$field['type'] = 'text';
	// 					break;
	// 				
	// 				default:
	// 					$field['type'] = 'textarea';
	// 					break;
	// 			}
	// 			
	// 			break;
	// 	//	int
	// 		case $attr['type'] == 'int':
	// 			$field['type'] = 'number';
	// 			if ($attr['key'] == 'id') $field['readonly'] = true;
	// 			break;
	// 	//	decimal
	// 		case $attr['type'] == 'decimal':
	// 			$field['type'] = 'number';
	// 			$field['step'] = $attr['round'];
	// 			break;
	// 	//	array
	// 		case $attr['type'] == 'array':
	// 			$field['type'] = 'array';
	// 		//	particularités
	// 			switch (true)
	// 			{
	// 			//	objet page
	// 				case $this->item->get_table() == 'page' && $attr['key'] == 'template':
	// 					$field['type'] = 'page';
	// 					break;
	// 			//	objet form
	// 				case $this->item->get_table() == 'form' && $attr['key'] == 'field':
	// 					$field['type'] = 'form';
	// 					break;
	// 			//	objet structure
	// 				case $this->item->get_table() == 'structure' && $attr['key'] == 'attr':
	// 					$field['type'] = 'attr';
	// 					break;
	// 				case $this->item->get_table() == 'structure' && $attr['key'] == 'rel':
	// 					$field['type'] = 'rel';
	// 					break;
	// 			//	objet section
	// 				case $this->item->get_table() == 'section' && $attr['key'] == 'template':
	// 					$field['type'] = 'app';
	// 					break;
	// 			//	objet group
	// 				case $this->item->get_table() == 'group' && $attr['key'] == 'right':
	// 					$field['type'] = 'right';
	// 					break;
	// 			}
	// 			break;
	// 	//	bool
	// 		case $attr['type'] == 'bool':
	// 			$field['type'] = 'bool';
	// 			break;
	// 	//	bool
	// 		case $attr['type'] == 'date':
	// 			$field['type'] = 'text';
	// 			break;
	// 	}
	// 	if (isset($attr['required'])) $field['required'] = $attr['required'];
	// 	if (isset($attr['min'])) $field['min'] = $attr['min'];
	// 	if (isset($attr['max'])) $field['max'] = $attr['max'];
		// print'<pre>';print_r($attr);print'</pre>';
		// 		print'<pre>';print_r($field);print'</pre><hr>';
		return $field;
	}
/**
 * Déduire le type de champ à afficher en fonction d'une relation de structure
 *
 * @param	array 	un attribut de structure
 * @access	public
 */
	private function _rel_to_field($rel)
	{
		// print'<pre>';print_r($rel);print'</pre>';
	//	key, label
		$field['key'] = $rel['key'];
		$field['label'] = (isset($rel['title']) && !empty($rel['title'])) ? $rel['title'] : $rel['key'];
	//	types
		switch (true)
		{
			case isset($rel['max']) && $rel['max'] == 1:
				$field['type'] = 'select';
				break;
			default:
				$field['type'] = 'multipleselect';
				break;
		}
	//	values
		$field['valuestype'] = 'bunch';
		$field['values'] = $rel['item'];
		if (isset($attr['required'])) $field['required'] = $attr['required'];
		return $field;
	}
/**
 * Peuplez les champs du formulaires avec les données de l'item
 *
 * @access	public
 */
	private function _populate_with_item()
	{
	//	attributs
		foreach ($this->item->data->data as $key => $value)
		{
			if (isset($this->form['field'][$key])) $this->form->data->data['field'][$key]['value'] = $value;
		}
	//	relations
		foreach ((array) $this->item->rel as $key => $value)
		{
			if (isset($this->form['field'][$key])) $this->form->data->data['field'][$key]['value'] = array_keys($value);
		}
	}

/**
 * Retourne le html du formulaire définit par son theme et son template
 * 
 * @return	string	le html du formulaire
 * @access	public
 */
	public function __tostring()
	{
		$this->_conform_to_structure();
		
		// $this->form->data->data['field']['save'] = array(
		// 	'type' => 'button',
		// 	'key' => 'save',
		// 	'buttontype' => 'submit',
		// 	'value' => 'save'
		// );
		
		if ($this->item->exists()) $this->_populate_with_item();
		// print'<pre>';print_r($this);print'</pre>';
	//	affichage
		return $this->form->__tostring();
	}
}
?>