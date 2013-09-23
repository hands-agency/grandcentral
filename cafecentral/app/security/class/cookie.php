<?php
/**
 * The cookie class of Café Central
 * 
 * @package		Security
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class cookie
{
/**
 * Constructeur de classe. Les cookies créés ne seront pas accessible au javascript (httponly)
 * 
 * http://php.net/manual/fr/function.setcookie.php
 *
 * @param	string	le nom du cookie
 * @param	string	la valeur du cookie
 * @param	string	Une chaîne date/heure. Utilise la fonction strtotime (http://php.net/manual/fr/function.strtotime.php)
 * @access	public
 */
	public function __construct($name, $value, $expire)
	{
		$this->name = $name;
		$this->value = $value;
		$this->expire = $expire;
	}
/**
 * Créer un cookie chez le client
 *
 * @access	public
 */
	public function save()
	{
		if ($expire = strtotime($this->expire))
		{
			setcookie($this->name, $this->value, $expire, '/', null, false, true);
		}
	}
}
?>