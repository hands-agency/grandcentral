<?php
/**
 * The generic item of Café Central
 *
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
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
		$key = mb_strtoupper($string);
		// var
		$lang = i(env, current)['version']['lang']->get();
		// recherche de la traduction
		$const = registry::get(env, 'const', $key);
		// print'<pre>';print_r($consts);print'</pre>';
		if (!empty($const))
		{
			return $const;
		}
		// ajout
		else
		{
			$const = i('const');
			$const['title'][$lang] = $string;
			$const['key'] = mb_strtoupper($string);
			$const->save();
			registry::set($const->get_env(), 'const', $const['key']->get(), $const['title']);
			return $const['title'][$lang];
		}
	}
}
?>