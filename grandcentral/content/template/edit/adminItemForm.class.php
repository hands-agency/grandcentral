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
class adminItemForm
{
	private $env;
	private $table;
	private $form;
	private $item;
	private $skip;
/**
 * Class constructor
 *
 * @param	string  admin ou site
 * @param	string 	la table de l'item à éditer
 * @param	mixed	l'identifiant ou la clé de l'objet à éditer
 * @access	public
 */
	public function __construct(_items $item, $skip = array())
	{
		$this->env = $item->get_env();
		$this->table = $item->get_table();
	//	recherche du formulaire
		$key = constant(mb_strtoupper($this->env).'_KEY').'_'.$this->table;
		$this->form = i('form', $key, $this->env);
		$this->form['key'] = $key;
		$this->form['title'] = $key;
		$this->form['template'] = 'default';
		$this->form['action'] = 'post';
		$this->form['method'] = 'post';
		$this->form['system'] = true;
	//	recherche de l'item à injecter dans le form
		$this->item = $item;
	//	Attr à sauter
		$this->skip = $skip;
	}
/**
 * Mettre en conformité le formulaire et la structure d'un item
 *
 * @access	private
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
			$structure = i('item', $this->table, $this->env);
			if ($structure['updated']->get() > $this->form['updated']->get())
			{
				$this->_update_form();
			}
		}
	}
/**
 * Mettre à jour le formulaire à partir des éléments de la structure
 *
 * @access	private
 */
	private function _create_form()
	{
	//	structure de référence
		$attrs = registry::get($this->env, registry::attr_index, $this->table, 'attr');;
	//	mise en conformité des attributs
		foreach ($attrs as $key => $attr)
		{
			if (isset($attr['key']) && !in_array($attr['key'], $this->skip)) $fields[$attr['key']] = $this->_attr_to_field($attr);
		}
		$this->form['field'] = $fields;
	//	sauvegarde du formulaire généré
		$this->form->save();
	}
/**
 * Mettre à jour le formulaire à partir des éléments de la structure
 *
 * @access	private
 */
	private function _update_form()
	{
		$this->_create_form();
	}

/**
 * Déduire le type de champ à afficher en fonction d'un attribut de structure
 *
 * @param	array 	un attribut de structure
 * @access	private
 */
	private function _attr_to_field($attr)
	{
		// print'<pre>';print_r($attr);print'</pre>';
	//	key, label
		$field['key'] = $attr['key'];
		$field['label'] = (isset($attr['title']) && !empty($attr['title'])) ? $attr['title'] : $attr['key'];
	//	types
		switch (true)
		{
		//	id
			case $attr['type'] == 'id':
				$field['type'] = 'number';
				$field['readonly'] = true;
				break;
		//	int
			case $attr['type'] == 'int':
				$field['type'] = 'number';
				break;
		//	media
			case $attr['type'] == 'media':
				$field['type'] = 'media';
				break;
		//	string
			case $attr['type'] == 'string':
			//	particularités
				switch (true)
				{
					case isset($attr['max']) && $attr['max'] <= 255:
						$field['type'] = 'text';
						break;

					default:
						$field['type'] = 'textarea';
						break;
				}
				break;
		//	key
			case $attr['type'] == 'key':
				$field['type'] = 'text';
				if ($this->item->get_table() == 'item') $field['required'] = true;
				break;
		//	bool
			case $attr['type'] == 'bool':
				$field['type'] = 'bool';
				break;
		//	list
			case $attr['type'] == 'list':
				$tmp = new attrList();
				$tmp->set_values($attr['values']);
				$tmp->set_placeholder($attr['placeholder']);
				$field['type'] = 'select';
				$field['valuestype'] = 'array';
				$field['placeholder'] = $tmp->get_placeholder();
				$field['values'] = $tmp->get_values();
				break;
		//	date, created, updated
			case in_array($attr['type'], array('created', 'updated', 'date')):
				$field['type'] = 'date';
				break;
		//	status
			case $attr['type'] == 'status':
				$field['type'] = 'text';
				break;
		//	Live
			case $attr['type'] == 'live':
				$field['type'] = 'text';
				break;
		//	item
			case $attr['type'] == 'item':
				$field['type'] = 'select';
				$field['valuestype'] = 'bunch';
				$field['placeholder'] = '...';
				$field['values'] = $attr['param'];
				break;
		//	url
			case $attr['type'] == 'url':
				$field['type'] = 'url';
				break;
		//	Password
			case $attr['type'] == 'password':
				$field['type'] = 'password';
				break;
		//	version
			case $attr['type'] == 'version':
				$field['type'] = 'text';
				break;
		//	version
			case $attr['type'] == 'i18n':
				$field['type'] = 'i18n';
				$field['field'] = $attr['field'];
				break;
		//	array
			case $attr['type'] == 'array':
				$field['type'] = isset($attr['field']) && !empty($attr['field']) ? mb_strtolower(mb_substr($attr['field'], 5)) : 'array';
			//	particularités
				switch (true)
				{
				//	objet page
					case $this->item->get_table() == 'page' && $attr['key'] == 'type':
						$field['type'] = 'pagetype';
						break;
				//	objet form
					case $this->item->get_table() == 'form' && $attr['key'] == 'field':
						$field['type'] = 'form';
						break;
				//	objet structure
					case $this->item->get_table() == 'item' && $attr['key'] == 'attr':
						$field['type'] = 'attr';
						break;
				//	objet section
					case $this->item->get_table() == 'section' && $attr['key'] == 'app':
						$field['type'] = 'app';
						break;
				//	objet group
					case $this->item->get_table() == 'group' && $attr['key'] == 'right':
						$field['type'] = 'right';
						break;
				}
				break;
		//	relation
			case $attr['type'] == 'rel':
				$field['valuestype'] = 'bunch';
				$field['values'] = $attr['param'];
				$field['placeholder'] = '...';
				$field['type'] = (isset($attr['max']) && $attr['max'] == 1) ? 'select' : 'multipleselect';
				break;

		//	Default field type
			default :
				$classes = registry::get(registry::class_index);
				// print'<pre>';print_r($classes);print'</pre>';
				if (isset($classes['field'.ucfirst($attr['type'])]))
				{
					$field['type'] = $attr['type'];
				}
				else
				{
					$field['type'] = 'text';
				}
				break;
		}
		if (isset($attr['required'])) $field['required'] = $attr['required'];
		if (isset($attr['min'])) $field['min'] = $attr['min'];
		if (isset($attr['max'])) $field['max'] = $attr['max'];

		return $field;
	}
/**
 * Peuplez les champs du formulaires avec les données de l'item
 *
 * @access	private
 */
	private function _populate_with_item()
	{
		foreach ($this->item as $key => $value)
		{
			if (isset($this->form['field'][$key]))
			{
				$field = $this->form['field'][$key];
				$field['value'] = $value->get();
				$this->form['field'][$key] = $field;
			}
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

		$this->_populate_with_item();
		// print'<pre>';print_r($this);print'</pre>';
		$form = $this->form->prepare();
		$form->set_action(i('page', 'post', 'admin')['url']);
	//	affichage
		return $form->__tostring();
	}
}
?>
