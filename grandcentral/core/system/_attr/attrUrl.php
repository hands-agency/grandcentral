<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrUrl extends attrArray
{
	protected $item;
	protected $old = false;
	protected $oldvalue;
/**
 * Set string attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function database_get()
	{
		// temporaire : pour éviter les effets de bords lors de la mise à jour de la page accueil
		if ($this->params['table'] == 'page' && $this->params['itemkey'] == 'home')
		{
			return '/';
		}
		// temporaire : si le contenu correspond à l'ancien format, on le met à jour
		if ($this->old === true && !empty($this->oldvalue))
		{
			foreach ($this->data as $key => $value)
			{
				$this->data[$key] = $this->oldvalue;
			}
		}
		// création du tableau des valeurs à insérer dans la base
		foreach (i('version',all,$this->params['env']) as $version)
		{
			$key = $version['key']->get();
			// si la valeur est vide, il faut la remplir
			if (empty($this->data[$key]))
			{
				// si pas de titre, on prend la clé
				if (empty($this->params['name']))
				{
					$value = $this->params['itemkey'];
				}
				// si un titre est disponible dans la version demandée
				elseif (isset($this->params['name'][$key]) && !empty($this->params['name'][$key]))
				{
					$value = $this->params['name'][$key];
				}
				// sinon, on va chercher un des titres disponibles
				else
				{
					echo "<pre>";print_r($this->params['name']);echo "</pre>";
					foreach ((array) $this->params['name'] as $value)
					{
						if (!empty($value))
						{
							break;
						}
					}
				}
				echo "<pre>";print_r($value);echo "</pre>";
				// affectation
				$this->data[$key] = $this->_slugify($this->exists_and_extend($value));
			}
		}

		// // création du tableau d'urls en fonction de ce qu'on récupère dans le titre
		// if (empty($this->data) && !empty($this->params['name']))
		// {
		// 	foreach ($this->params['name'] as $key => $value)
		// 	{
		// 		if (empty($key))
		// 		{
		// 			$key = i($this->params['env'], current)['version']['lang']->get();
		// 		}
		// 		$value = preg_replace('#(\[[^\]]*\])#', '', $value);
		// 		$this->data[$key] = $this->_slugify($this->exists_and_extend($value));
		// 	}
		// }
		// // remplissage du tableau s'il manque des éléments
		// else
		// {
		// 	// echo "<pre>";print_r(registry::get());echo "</pre>";exit;
		//
		// }
	//	Return
		return (!empty($this->data)) ? json_encode($this->data, JSON_UNESCAPED_UNICODE) : '';
	}
/**
 * Set array attribute for database
 *
 * @param	array	attribute data
 * @access	public
 */
	public function database_set($data)
	{
		// new url format
		if (mb_substr($data, 0, 1) == '{')
		{
			$this->data = json_decode($data, true);
		}
		// old url format
		else
		{
			$current = i($this->params['env'], current);
			$key = (!empty($current)) ? i($this->params['env'], current)['version']['lang']->get() : 0;
			$this->data[$key] = $data;
			$this->old = true;
			$this->oldvalue = $data;
		}
		return $this;
	}
/**
 * Check for existing URL
 *
 * @param		string	l'url à vérifier
 * @return	bool	true si elle existe ou false
 * @access	public
 */
	public function exists_and_extend($url)
	{
	//
		$db = database::connect($this->params['env']);
	 	$q = 'SELECT COUNT(`id`) as `count` FROM `'.$this->params['table'].'` WHERE `url` LIKE "%'.$url.'%" AND id != "'.$this->params['id'].'"';
		$r = $db->query($q);
		if ($r['data'][0]['count'] > 0)
		{
			$letters = 'abcefghijklmnopqrstuvwxyz1234567890';
 			$rand = substr(str_shuffle($letters), 0, 6);
			$url .= '-'.$rand;
		}
		return $url;
	}
/**
 * Add a reader on the attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set_reader($value)
	{
		$this->params['reader'] = $value;
		$this->params['table'] = registry::get(registry::reader_index, $value, 'url');
	}
/**
 * Get complete item url
 *
 * @return	string	url
 * @access	public
 */
	public function attach(_items &$item)
	{
		$this->params['table'] = $item->get_table();
		$this->params['env'] = $item->get_env();
		$this->params['version'] = (isset($item['version']) && !$item['version']->is_empty()) ? $item['version'] : null;
		$this->params['live'] = $item['live'];
		$this->params['itemkey'] = $item['key']->get();
		$this->params['nickname'] = $item->get_nickname();
		$this->params['id'] = $item['id']->get();
		$this->params['name'] = $item['title']->get();

		// récupération des données des champs titre
		// switch (true)
		// {
		// 	// no title
		// 	case !isset($item['title']) || $item['title']->is_empty():
		// 		$this->params['name'] = $item['key']->get();
		// 		break;
		// 	default:
		// 		$this->params['name'] = $item['title']->get();
		// 		break;
		// }
	}
/**
 * php http_build_query() on url
 *
 * @param	array	get arguments
 * @return	string	url
 * @access	public
 */
	public function args($arg)
	{
		// print'<pre>';print_r($arg);print'</pre>';
		$url = $this->__tostring();
		$url .= (!empty($arg)) ? '?'.http_build_query($arg) : '';
		return $url;
	}
/**
 * get the current url in another version, if exists
 *
 * @param		string	version key
 * @return	string	url
 * @access	public
 */
	public function get_version($version_key)
	{
		return '';
	}
/**
 * Return the current version of url hash
 *
 * @param	array	get arguments
 * @return	string	url
 * @access	public
 */
	public function get_current()
	{
		$r = $this->get();
		$v = i($this->params['env'], current)['version']['lang']->get();
		// new version
		if (isset($r[$v]) && !empty($r[$v]))
		{
			return $r[$v];
		}
		// old return
		else
		{
			return implode('',$r);
		}
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __tostring()
	{
		$url = '';
		// version url
		if (is_null($this->params['version']))
		{
			$url = i($this->params['env'], current)['version']->get_url();
		}
		else
		{
			$version = constant(mb_strtoupper($this->params['env']).'_VERSION');
			$url = constant('VERSION_'.mb_strtoupper($version));
		}
		// reader
		if ($this->params['table'] != 'page')
		{
			foreach (registry::get(registry::reader_index) as $page => $table)
			{
				if (isset($table[0]['param']) && $this->params['table'] == $table[0]['param']['item'])
				{
					$tmp = registry::get(registry::url_index, $page);
					// new url format
					if (mb_substr($tmp, 0, 1) == '{')
					{
						$t = json_decode($tmp, true);
						$tmp = $t[i('version', current)['lang']->get()];
					}

					if ($tmp != '/') $url .= $tmp;
					break;
				}
			}
		}
		// return
		return $url.$this->get_current();

	}
/**
 * Slugify a string
 * ex : "Hello World !" -> "hello-world"
 *
 * @param		string	string to transform
 * @return	string	transformed string
 * @access	public
 */
	protected function _slugify($string)
	{
		$string = trim(trim($string), '-');

		if (mb_substr($string, 0, 1) == '/')
		{
			$string = mb_substr($string, 1);
		}

		$slug = new slug();
		$return = '/'.$slug->makeSlugs($string);

		return $return;
	}
/**
 * Default field attributes for updated
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		$params['key']['value'] = 'url';
		$params['key']['readonly'] = true;
		unset($params['required']);
	//	Return
		return $params;
	}
}
?>
