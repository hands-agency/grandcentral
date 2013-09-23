<?php
/**
 * Handles data fetched in the database
 *
 * a data = one line in the database
 * 
 * @package  Core
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class dataHuman extends data
{
	protected $hash;
	
	public function set_data($data)
	{
		parent::set_data($data);
		$this->hash = $this->data['password'];
		// unset($this->data['password']);
	}
	
/**
 * Expérimental : préparer les clauses INSERT dans la table _rel (requêtes préparées)
 *
 * @return	string	la requête INSERT INTO ... VALUES
 * @access	public
 */
	public function prepare_save()
	{
		if ($this->hash != $this->data['password'] && !empty($this->data['password']))
		{
			$bcrypt = new bcrypt(human::round);
			$this->data['password'] = $bcrypt->hash($this->data['password']);
		}
		else
		{
			// $this->data['password'] = $this->hash;
		}
		parent::prepare_save();
	}
}
?>