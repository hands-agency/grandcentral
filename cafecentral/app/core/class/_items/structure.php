<?php
/**
 * The structure item
 *
 * This class lets you create, handle and delete the structure of items in the database
 * We do not load the item variable with data, but rather return it in variables
 * condidering the structure is a super touchy thing to manipulate.
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class structure extends _items
{
	private $key;
	private $versionable;
	private $attrs;
/**
 * Gets the current structure. You can find all structures in the registry
 * Les structures ne sont accessibles que par leur key et leur id
 *
 * @access	public
 */
	public function set_data(_datas $data)
	{
		parent::set_data($data);
		$this->key = $this['key'];
		$this->versionable = $this['versionable'];
		$this->attrs = $this['attr'];
	}
/**
 * Vérifie que la valeur de l'attribut versionnable
 *
 * @return	bool	true ou false
 * @access	public
 */
	public function is_versionable()
	{
		return $this['versionable'];
	}
/**
 * Vérifie que l'attribut existe dans la structure
 *
 * @param	string	la clé de l'attribut
 * @return	bool	true ou false
 * @access	public
 */
	public function attr_exists($value)
	{
		return (isset($this->data->data['attr'][$value])) ? true : false;
	}
/**
 * Vérifie que la relation existe dans la structure
 *
 * @param	string	la clé de la relation
 * @return	bool	true ou false
 * @access	public
 */
	public function rel_exists($value)
	{
		return (isset($this->data->data['rel'][$value])) ? true : false;
	}
/**
 * Vérifie que la structure dispose de relations
 *
 * @return	bool	true ou false
 * @access	public
 */
	public function has_rel()
	{
		return (empty($this->data->data['rel'])) ? false : true;
	}
/**
 * Vérifie que la structure existe dans la bdd
 *
 * @return	bool	true ou false
 * @access	public
 */
	public function exists()
	{
		// return true;
		$key = (isset($this->key) && !empty($this->key)) ? $this->key : $this['key'];
		return (parent::exists() && in_array($key, database::get_tables($this->get_env()))) ? true : false;
	}
/**
 * Ajouter / remplacer un attribut
 *
 * @param	string	la clé de l'attribut
 * @param	array	les paramètres de l'attribut
 * @access	public
 */
	public function set_attr($key, $attr)
	{
		if (!isset($attr['key'])) $attr['key'] = $key;
		$this->data->data['attr'][$key] = $attr;
		return $this;
	}
/**
 * Ajouter / remplacer un attribut, puis le déplace à l'endroit voulu
 *
 * @param	string	la clé de l'attribut
 * @param	array	les paramètres de l'attribut
 * @param	mixed	0 ou clé de l'attribut précédent. Si 0 l'attribut sera placé en première position, sinon il sera placé juste après l'attribut dont on donne la clé
 * @access	public
 */
	public function insert_attr($key, $attr, $position)
	{
		$this->set_attr($key, $attr);
		$this->deplace_attr($key, $position);
		return $this;
	}
/**
 * Déplacer un attribut à l'endroit voulu
 *
 * @param	string	la clé de l'attribut
 * @param	mixed	0 ou clé de l'attribut précédent. Si 0 l'attribut sera placé en première position, sinon il sera placé juste après l'attribut dont on donne la clé
 * @access	public
 */
	public function deplace_attr($key, $position)
	{
		if (isset($this->data->data['attr'][$key]))
		{
			$attr = $this->data->data['attr'][$key];
			unset($this->data->data['attr'][$key]);
			if ($position === 0)
			{
				$attrs = array_reverse($this->data->data['attr'], true);
				$attrs[$key] = $attr;
				$this->data->data['attr'] = array_reverse($attrs, true);
			}
			elseif (isset($this->data->data['attr'][$position]))
			{
				$columns = array_keys($this['attr']);
				$pos = array_search($position, $columns) + 1;
				$i = 0;
				foreach ($this['attr'] as $k => $value)
				{
					if ($i < $pos)
					{
						$attrs[$k] = $value;
					}
					if ($i == $pos)
					{
						$attrs[$key] = $attr;
					}
					if ($i >= $pos)
					{
						$attrs[$k] = $value;
					}
					$i++;
				}
				$this['attr'] = $attrs;
			}
		}
		return $this;
	}
/**
 * Supprimer un attribut
 *
 * @param	string	la clé de l'attribut à supprimer
 * @access	public
 */
	public function delete_attr($key)
	{
		if ($this->attr_exists($key))
		{
			unset($this->data->data['attr'][$key]);
		}
		return $this;
	}
/**
 * Vérifie la validité de l'attribut passé en paramètre
 *
 * @param	array	le tableau de définition de l'attribut
 * @return	bool	true ou false
 * @access	public
 */
	public function is_valid_attr($attr)
	{
		return (isset($attr['key']) && isset($attr['type'])) ? true : false;
	}
/**
 * Sauvegarder une structure et créer / altérer la table liée
 *
 * @access	public
 */
	public function prepare_save()
	{
		if (!empty($this['attr']))
		{
		//	version obligatoire pour les objets versionable
			if ($this->is_versionable())
			{
				$this->data->data['rel']['version'] = array(
		            'key' => 'version',
					'item' => array(1 => array('item' => cc('structure', 'version')->get_nickname())),
					'min' => 0,
            		'max' => 0,
		            'required' => true,
				);
			}
			else
			{
				unset($this->data->data['rel']['version']);
			}
		//	création de la requête mysql
			($this->exists()) ? $this->_alter() : $this->_create();
		}
		else
		{
			trigger_error('Sauvegarde impossible : la liste des attributs de la structure <strong>'.$this['key'].'</strong> ne peut être vide.', E_USER_ERROR);
		}
	//	sauvegarde dans la table structure
		// parent::save();
		// print '<pre>';print_r($this);print'</pre>';
		return $this;
	}
/**
 * Créer une nouvelle table dans la bdd
 *
 * @access	private
 */
	private function _create()
	{
	//	on ajoute les attributs pas défaut
		$this->_populate_default_attr();
	//	on construit les définitions mysql
		foreach ($this['attr'] as $key => $attr)
		{
			if ($this->is_valid_attr($attr))
			{
				$columns[] = $this->_column_definition($attr);
				if (isset($attr['index']) && empty($attr['index'])) unset($this->data->data['attr'][$key]['index'], $attr['index']);
				if (isset($attr['index']))
				{
					$keys[] = $this->_key_definition($attr);
				}
			}
		}
	//	requête create table
		$q = 'CREATE TABLE IF NOT EXISTS `'.constant(strtoupper($this->get_env()).'_DB_NAME').'`.`'.$this['key'].'` ('.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $columns).','.PHP_EOL.'	'.implode(','.PHP_EOL.'	', $keys).''.PHP_EOL.') ENGINE=InnoDB DEFAULT CHARSET='.database::charset.' COLLATE='.database::collation.';';
		// print '<pre>';print_r($q);print'</pre>';
		$db = database::connect($this->get_env());
		$db->query($q);
	}
/**
 * Modifier une table dans la bdd
 *
 * @access	private
 */
	private function _alter()
	{
	//	rename table
		if ($this->key != $this['key'])
		{
			$this->_rename_table();
		}
	//	on restaure toujours les attributs par défaut
		$this->_populate_default_attr();
		// print '<pre>';print_r($this);print'</pre>';
	//	création de l'index des colonnes
		$this->columns = array_keys($this['attr']);
	//	on nettoie les index
		foreach ($this['attr'] as $key => $attr)
		{
			if (isset($attr['index']) && empty($attr['index'])) unset($this->data->data['attr'][$key]['index']);
		}
	//	on détermine ce qui change
		$change = array_intersect_key($this['attr'], $this->attrs);
		$add = array_diff_key($this['attr'], $this->attrs);
		$drop = array_diff_key($this->attrs, $this['attr']);
	//	CHANGE
		foreach ($change as $key => $attr)
		{
			if ($this->is_valid_attr($attr))
			{
				$definition = $this->_change_column_definition($key, $attr);
				$definition .= $this->_column_position($attr['key']);
				$definitions[$attr['key']] = $definition;
			//	si je n'avais pas de clé d'indexation sur le champ et maintenant j'en ai une
				if (isset($attr['index']) && !isset($this->attrs[$key]['index']))
				{
					$tmp = $this->_add_key_definition($attr);
					if (!empty($tmp)) $keys[] = $tmp;
				}
			//	si j'avais une clé d'indexation sur le champ et maintenant j'en ai plus
				elseif (isset($this->attrs[$key]['index']) && !isset($attr['index']))
				{
					$tmp = $this->_drop_key_definition($key, $attr);
					if (!empty($tmp)) $keys[] = $tmp;
				}
			//	si j'avais une clé d'indexation sur la colonne, que j'en ai toujours une mais qu'elle est différente
				elseif (isset($this->attrs[$key]['index']) && isset($attr['index']) && $this->attrs[$key]['index'] != $attr['index'])
				{
					$keys[] = $this->_drop_key_definition($key, $attr);
					$keys[] = $this->_add_key_definition($attr);
				}
			}
		}
	//	ADD
		foreach ($add as $attr)
		{
			if ($this->is_valid_attr($attr))
			{
				$definition = $this->_add_column_definition($attr);
				$definition .= $this->_column_position($attr['key']);
				$definitions[$attr['key']] = $definition;
				// if (isset($attr['index']) && empty($attr['index'])) unset($this->data->data['attr'][$attr['key']]['index'], $attr['index']);
				if (isset($attr['index']))
				{
					$tmp = $this->_add_key_definition($attr);
					if (!empty($tmp)) $keys[] = $tmp;
				}
			}
		}
	//	DROP
		// $drop = array_diff_key($this['attr'], $change, $add);
		// print '<hr><pre><strong>$this[attr]</strong> : ';print_r($this->data->data['attr']);print'</pre>';
		// print '<hr><pre><strong>add</strong> : ';print_r($add);print'</pre>';
		// print '<hr><pre><strong>change</strong> : ';print_r($change);print'</pre>';
		// print '<pre><strong>drop</strong> : ';print_r($drop);print'</pre><hr>';
		foreach ($drop as $attr)
		{
			$tmp = $this->_drop_column_definition($attr);
			if (!empty($tmp)) $drops[] = $tmp;
			
		}
	//	ré-organisation des définitions et mise au propre de l'arbre des attributs
		foreach ($this->columns as $key)
		{
			$orderedDefinitions[] = $definitions[$key];
		}
		// print '<pre>';print_r($this->columns);print'</pre>';
	//	requête alter table
		$q = 'ALTER TABLE `'.$this['key'].'` '.PHP_EOL.implode(','.PHP_EOL, $orderedDefinitions);
		if (isset($drops)) $q .= ','.PHP_EOL.implode(','.PHP_EOL, $drops);
		if (isset($keys)) $q .= ','.PHP_EOL.implode(','.PHP_EOL, $keys);
		// print '<pre>';print_r($q);print'</pre>';
		$db = database::connect($this->get_env());
		$db->query($q);
	}
/**
 * Obtenir la définition mysql d'une colonne de la table en fonction du tableau d'attribut
 *
 * @param	array 	la définition de l'attribut
 * @return	string 	la définition mysql de l'attribut
 * @access	private
 */
	private function _column_definition($attr)
	{
	//	création de la définition
		$attrClass = 'attr'.ucfirst($attr['type']);
		$definition = $attrClass::mysql_definition($attr);
	//	ajout du commentaire sur la colonne
		if (isset($attr['title']) && !empty($attr['title']))
		{
			$definition .= ' COMMENT "'.$attr['title'].'"';
		}
	
		return $definition;
	}
/**
 * ALTER - Obtenir la définition mysql d'une nouvelle colonne de la table en fonction du tableau d'attribut
 *
 * @param	array 	la définition de l'attribut
 * @return	string 	la définition mysql de l'attribut
 * @access	private
 */
	private function _add_column_definition($attr)
	{
		return 'ADD '.$this->_column_definition($attr);
	}
/**
 * ALTER - Obtenir la définition mysql d'une colonne déjà existante de la table en fonction du tableau d'attribut
 *
 * @param	array 	la définition de l'attribut
 * @return	string 	la définition mysql de l'attribut
 * @access	private
 */
	private function _change_column_definition($key, $attr)
	{
		if ($key != $attr['key'])
		{
			$pos = array_search($key, $this->columns);
			$this->columns[$pos] = $attr['key'];
			$previous = $this->columns[$pos - 1];
			$this->insert_attr($attr['key'], $attr, $previous);
			$this->delete_attr($key);
		}
		return 'CHANGE `'.$key.'` '.$this->_column_definition($attr);
	}
/**
 * ALTER - Obtenir la définition mysql d'une colonne à supprimer de la table en fonction du tableau d'attribut
 *
 * @param	array 	la définition de l'attribut
 * @return	string 	la définition mysql de l'attribut
 * @access	private
 */
	private function _drop_column_definition($attr)
	{
		return 'DROP `'.$attr['key'].'`';
	}
/**
 * ALTER - Obtenir la définition mysql de la position d'une colonne
 *
 * @param	string 	la clé de l'attribut
 * @return	string 	la définition mysql de la position de l'attribut
 * @access	private
 */
	private function _column_position($key)
	{
		$pos = array_search($key, $this->columns);
		$position = ($pos == 0) ? 'FIRST' : 'AFTER `'.$this->columns[$pos - 1].'`';
		return ' '.$position;
	}
/**
 * Obtenir la définition mysql d'un index de la table en fonction du tableau d'attribut
 *
 * @param	array 	la définition de l'attribut
 * @return	string 	la définition mysql de l'index
 * @access	private
 */
	private function _key_definition($attr)
	{
	//	pour toutes les clés primaires qui ne sont pas des id, on transforme en unique
		if ($attr['index'] == 'primary' && $attr['key'] != 'id')
		{
			$attr['index'] = 'unique';
		}
	//	pour les structures d'objet versionable, on transforme les clefs uniques en index
		if (isset($attr['index']) && $this->is_versionable() && $attr['index'] == 'unique')
		{
			$attr['index'] = 'index';
		}
	//	définition mysql de la clé
		switch ($attr['index'])
		{
			case 'primary':
				$key = 'PRIMARY KEY (`'.$attr['key'].'`)';
				break;
			case 'unique':
				$key = 'UNIQUE KEY `'.$attr['key'].'` (`'.$attr['key'].'`)';
				break;
			case 'index':
				$key = 'KEY `'.$attr['key'].'` (`'.$attr['key'].'`)';
				break;
		}
		return $key;
	}
/**
 * ALTER - Obtenir la définition mysql d'un nouvel index de la table en fonction du tableau d'attribut
 *
 * @param	array 	la définition de l'attribut
 * @return	string 	la définition mysql de l'index
 * @access	private
 */
	private function _add_key_definition($attr)
	{
		return 'ADD '.$this->_key_definition($attr);
	}
/**
 * Obtenir la définition mysql d'un index à supprimer de la table en fonction du tableau d'attribut
 *
 * @param	string 	la clé de l'attribut (dans $this->attrs)
 * @param	array 	la définition de l'attribut
 * @return	string 	la définition mysql de l'index à supprimer
 * @access	private
 */
	private function _drop_key_definition($key, $attr)
	{
		$drop = null;
		switch ($this->attrs[$key]['index'])
		{
			case 'primary':
				$drop = 'DROP PRIMARY KEY';
				break;
			case 'unique':
			case 'index':
				$drop = 'DROP INDEX `'.$key.'`';
				break;
		}
		return $drop;
	}
/**
 * Renommer une table mysql
 *
 * @access	private
 */
	private function _rename_table()
	{
		$database = constant(strtoupper($this->get_env()).'_DB_NAME');
		$q = 'RENAME TABLE  `'.$database.'`.`'.$this->key.'` TO  `'.$database.'`.`'.$this['key'].'` ;';
		$db = database::connect($this->get_env());
		$db->_pdo->query($q);
		// print '<pre>';print_r($q);print'</pre>';
	}
/**
 * Supprimer l'objet structure de la base et sa table mysql liée
 *
 * @access	public
 */
	public function delete()
	{
		$database = constant(strtoupper($this->get_env()).'_DB_NAME');
		$q = 'DROP TABLE IF EXISTS `'.$database.'`.`'.$this['key'].'`';
		$db = database::connect($this->get_env());
		$db->_pdo->query($q);
		parent::delete();
		// print '<pre>';print_r($q);print'</pre>';
	}
/**
 * Peupler par défaut les attributs de la structure. 
 *
 * @access	private
 */
	private function _populate_default_attr()
	{
	//	ajout de l'id si elle est absente
		if (!isset($this->data->data['attr']['id']))
		{
			$attrs = array_reverse($this->data->data['attr'], true);
			$attrs['id'] = array(
				'key' => 'id',
				'type' => 'int',
				'title' => 'The unique identifier',
				'min' => 0,
				'max' => 0,
				'required' => false,
				'auto_increment' => true,
				'index' => 'primary'
			);
			$this->data->data['attr'] = array_reverse($attrs, true);
		}
	//	ajout de la clef si elle est absente
		if (!isset($this->data->data['attr']['key']))
		{
			$this->data->data['attr']['key'] = array(
				'key' => 'key',
				'type' => 'string',
				'title' => 'The key',
				'min' => 0,
				'max' => 32,
				// 'required' => true,
				'index' => 'unique'
			);
		}
	//	date de création
		$this->data->data['attr']['created'] = array(
			'key' => 'created',
			'type' => 'date',
			'format' => 'datetime',
			'title' => 'Created Datetime'
		);
	//	date de mise à jour
		$this->data->data['attr']['updated'] = array(
			'key' => 'updated',
			'type' => 'date',
			'format' => 'datetime',
			'title' => 'Updated Datetime'
		);
	//	état
		$this->data->data['attr']['status'] = array(
			'key' => 'status',
			'type' => 'string',
			'title' => 'Status',
			'min' => 0,
			'max' => 32,
			'index' => 'index'
		);
		
	//	author
	/*	if ($this->get_env() == 'site')
		{
			$this->data->data['rel']['author'] = array(
				'key' => 'author',
				'title' => 'Author(s)',
				'item' => 'human'
			);
		}
	*/
	}
/**
 * Rechercher et mettre en registre toutes les structures de l'admin et du site
 *
 * @access	private
 * @static
 */
	public static function prepare()
	{
		foreach (array('admin', 'site') as $env)
		{
			$s = new bunch('structure', null, $env);
			registry::set($env, 'structure', $s);
		}
	}
}
?>