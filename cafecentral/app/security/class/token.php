<?php
/**
 * The token item of Café Central
 * 
 * Le token est a usage unique. Le fait de le sélectionner dans la base l'efface automatiquement.
 *
 * @package		Security
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class token extends _items
{
/**
 * Gets the user item from the database
 *
 * @param	mixed  une id, une clé ou un tableau array('id' => 2)
 * @access	public
 */
	public function set_data(_datas $data)
	{
	//	lorsqu'on recehrche dans la bdd un token et on le trouve, on le supprime automatiqement
		// $attr = array(
		// 			'id' => $param,
		// 			'limit()' => 1
		// 		);
		// 		$db = database::connect($this->get_env());
		// 		$data = $db->querydata($this->get_table(), $attr, null);
		// print '<pre>';print_r($data);print'</pre>';
		// if (isset($data[0]))
		// 		{
		// 			$this->data = $data[0];
		// 			$this->delete();
		// 		}
	}
/**
 * Saves a token in the database
 *
 * @access	public
 */
	protected function _prepare_save()
	{
	//	on vérifie que tous les champs soient remplis
		if (!empty($this['id']) && !empty($this['key']) && !empty($this['validity']))
		{
			$id = $this['id'];
			$this->data->insert();
			$this['id'] = $id;
		}
		// parent::
	}
/**
 * Generer un token
 *
 * @param	object	l'objet lié au token
 * @param	string	La durée de validité du cookie écrit à la manière de strtotime (ex : "+1 day") (http://php.net/manual/fr/function.strtotime.php)
 * @access	public
 */
	public function generate($item, $validity)
	{
		$this['id'] = uniqid(null, true);
		$this['key'] = $item->get_nickname();
		$date = new dateTime();
		$date->modify($validity);
		$this['validity'] = $date->format('Y-m-d H:i:s');
	}
	
/**
 * Créer un cookie correspondant au token
 *
 * @access	public
 */
	public function set_cookie($name)
	{
		$cookie = new cookie($name, $this['id'], $this['validity']);
		$cookie->save();
	}
/**
 * Gets the user item from the database
 *
 * @access	public
 */
	public function is_valid()
	{
		$now = new DateTime();
		$validity = new DateTime($this['validity']);
		$interval = $validity->getTimestamp() - $now->getTimestamp();
		return ($interval > 0) ? true : false;
	}
/**
 * Va chercher l'objet lié au token
 *
 * @access	public
 */
	public function get_reference()
	{
		list($table, $id) = explode('_', $this['key']);
		// $ccClasses = array_keys(registry::get('app_by_class'));
		$i = item::create($table, $id, $this->get_env());
		// if ($table != 'item' && in_array($table, $ccClasses) && is_subclass_of($table, '_items'))
		// 		{
		// 			$obj = new $table($id, $this->get_env());
		// 		}
		// 		else
		// 		{
		// 			$obj = new item($table, $id, $this->get_env());
		// 		}
		return ($i->exists()) ? $i : null;
	}
}
?>