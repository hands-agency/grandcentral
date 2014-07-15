<?php
/**
 * Installation class
 * 
 * Create dir, fill database and create inc.config.php
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class gcInstall
{
	private $admin = 'gc_admin.sql';
	private $site = 'gc_site.sql';
	private $config = 'inc.config.php';
	private $data;
/**
 * Install init
 *
 * @param	mixed	l'objet cc ou le nom de l'objet
 * @access	public
 */
	public function __construct($data)
	{
		// vérification de la données
		
		// vars
		$this->path = realpath(dirname(__FILE__));
		$this->data = $data;
		// création du répertoire site
		$dir = new dir(SITE_ROOT.'/'.$data['site_key']);
		var_dump($dir->exists());
		if (!$dir->exists()) $dir->save();
		// création des bases de données
		$this->connect('admin');
		$this->connect('site');
		// remplissage des bases
		$this->import('admin');
		$this->import('site');
		// création du fichier de config
		$this->config();
		// redirection vers l'admin
		header('location:'.$this->data['site_url'].'/admin');
	}
	
	public function connect($env)
	{
		try
		{
			$dbh = new PDO('mysql:host='.$this->data[$env.'_db_host'], $this->data[$env.'_db_user'], $this->data[$env.'_db_password']);
			$dbh->exec('
					CREATE DATABASE IF NOT EXISTS `'.$this->data[$env.'_db_name'].'`;
			        CREATE USER "'.$this->data[$env.'_db_user'].'"@"localhost" IDENTIFIED BY "'.$this->data[$env.'_db_password'].'";
			        GRANT ALL ON `'.$this->data[$env.'_db_name'].'`.* TO "'.$this->data[$env.'_db_user'].'"@"localhost";
			        FLUSH PRIVILEGES;') 
			or die(print_r($dbh->errorInfo(), true));
		}
		catch (PDOException $e)
		{
			die("DB ERROR: ". $e->getMessage());
		}
	}
	
	public function import($env)
	{
		try
		{
			$db = new PDO('mysql:host='.$this->data[$env.'_db_host'].';dbname='.$this->data[$env.'_db_name'], $this->data[$env.'_db_user'], $this->data[$env.'_db_password']);
			$sql = file_get_contents($this->path.'/data/gc_'.$env.'.sql');
			$qr = $db->exec($sql);
		}
		catch (PDOException $e)
		{
			die("DB ERROR: ". $e->getMessage());
		}
	}
	
	public function config()
	{
		$template = new file($this->path.'/data/'.$this->config);
		$data = $template->get();
		$from = array_keys($this->data);
		$to = array_values($this->data);
		$data = str_replace($from, $to, $data);
		$file = new file(DOCUMENT_ROOT.'/'.$this->config);
		$file->set($data);
		$file->save();
	}
}
?>