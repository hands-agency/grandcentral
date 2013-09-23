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
class item_form extends _items
{
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @param	string  admin ou site (environnement courant par défaut)
 * @access	public
 */
	public function __construct($param = null, $env = env)
	{
		$this->data = new data('form', $env);
		if ($param != null) $this->get($param);
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
		$this->data->data['field'][$field][$param] = $value;
		return $this;
	}
	
/**
 * Retourne le html du formulaire définit par son theme et son template
 * 
 * @return	string	le html du formulaire
 * @access	public
 */
	public function __tostring()
	{
	//	paramètres du formulaire HTML
		$params = array(
			'data-item' => 'form_'.$this['id'],
			'data-key' => $this['key'],
			'action' => cc('page', 'post', $this->get_env())->link(),
			'method' => $this['method'],
			'enctype' => $this['enctype'],
			'target' => $this['target'],
			'theme' => $this['theme'],
			'template' => $this['template'],
		);
	//	instanciation du formulaire
		$form = new form($params);
		// print'<pre>';print_r($form);print'</pre>';
	//	ajout des champs
		if (isset($this['field']))
		{
			foreach ((array) $this['field'] as $data)
			{
				if ($data['type'] == 'fieldset')
				{
					$form->set_fieldset($data);
				}
				else
				{
					$form->set_field($data['type'], $this['key'].'['.$data['key'].']', $data);
				}
			}
		}
	//	affichage
		return $form->__tostring();
	}
}
?>