<?php
/**
 * The generic item of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemConst extends _items
{
/**
 * Fill the object with all his attributes
 *
 * @param	array 	attributes array
 * @access  public
 */
	public function database_set($data)
	{
		parent::database_set($data);
		registry::set($this->get_env(), 'const', $this['key']->get(), $this['title']);
	}
/**
 * Translate a constant text
 *
 * @param	string 	string to translate
 * @access  public
 */
	public static function t($string)
	{
		if (empty($string)) return '';
		$key = mb_strtoupper(mb_substr($string, 0, 64));
		// var
		$lang = i(env, current)['version']['lang']->get();
		// recherche de la traduction
		$const = registry::get(env, 'const', $key);
		if (!empty($const))
		{
			return $const;
		}
		// ajout
		else
		{
			$const = i('const');
			$const['title'][$lang] = $string;
			$const['key'] = $key;
			$const->save();
			registry::set($const->get_env(), 'const', $const['key']->get(), $const['title']);
			return $const['title'][$lang];
		}
	}
}
?>
