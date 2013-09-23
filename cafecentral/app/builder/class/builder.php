<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 * 
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class appbuilder extends app
{
//	Comes from the app class
	public $root;
//	The other parameters
	public $param;
//	Comes from the app class
	public $approot;

/**
 * returns the sample data
 *
 * @param  string  $sample the sample data
 * @return array   all of the exciting sample options
 * @access private
 */
	public function __construct($param)
	{
	}

/**
 * returns the sample data
 *
 * @param  string  $sample the sample data
 * @return array   all of the exciting sample options
 * @access private
 */
	public function build($param)
	{
	//	Paramaters
		$this->param = $param;
	//	The root
		$this->approot = CC_APP_ROOT.'/'.$this->param['key'];
		
	//	Create directory
		if (!is_dir($this->approot))
		{
			mkdir($this->approot, 0755);
			$_p = array(
				'What went well' => 'Your <dfn title="'.$this->approot.'">app directory</dfn> has been created',
			);
			sentinel::log('SUCCESS', $_p);
		}
		else
		{
			$_p = array(
				'What went wrong' => 'Sorry, there\'s already an installed app called '.$this->param['key'],
				'Try that' => 'Another name maybe?',
			);
			sentinel::log(E_WARNING, $_p);
		}
		
	//	Create config file
		$file = '/config.ini';
		$handle = fopen($this->approot.$file, 'w') or die("can't open file");
	//	Write in the config file
		$data = $this->build_config();
		fwrite($handle, $data);
	//	Close
		fclose($handle);
	}

/**
 * returns the sample data
 *
 * @param  string  $sample the sample data
 * @return array   all of the exciting sample options
 * @access private
 */
	private function build_config()
	{
	//	Some automatic data
		$_cc = cc::getInstance();
		$_user = user::getInstance();
		
	//	Some default parameters
		$p = $this->param;
		dflt($p['title'], 'A '.$this->key.' app for Café Central.');
		dflt($p['descr'], 'A Short description of your app.');
		dflt($p['scope'], 'html');
		dflt($p['v'], '0.0.1');
		dflt($p['v_descr'], 'A pet name for your release.');
		dflt($p['licence'], 'The Release licence');
		dflt($p['author'], $_user['firstname'].' '.$_user['lastname'].' ['.$_user['key'].']');
		dflt($p['company'], 'Your company');
		dflt($p['company_desc'], 'A quick description of your company');
		dflt($p['url'], 'http://www.domain.com/'.$this->param['key'].'-cc');
		dflt($p['credit'], 'Don t forget to thank the people you learn from. Yes, including your mom.');
		dflt($p['cc'], $_cc['v']);
		dflt($p['php'], phpversion());
		dflt($p['mysql'], database::version(env));
		dflt($p['app'], 'cc');
		dflt($p['class'], '/class/'.$this->param['key'].'.php');
		dflt($p['lib'], '/lib/'.$this->param['key'].'.php');
		
	//	A standard conf file
		$conf = array(
			'about' => array(
				'title' => $p['title'],
				'descr ' => $p['descr'],
				'scope' => array($p['scope']),
				'v' => $p['v'],
				'v_descr ' => $p['v_descr'],
				'licence' => $p['licence'],
				'author' => array($p['author']),
				'company' => $p['company'],
				'company_desc' => $p['company_desc'],
				'url ' => $p['url'],
				'credit' => array($p['credit']),
			),
			'requirements' => array(
				'cc' => $p['cc'],
				'php' => $p['php'],
				'mysql' => $p['mysql'],
			),
			'dependencies' => array(
				'app' => array($p['app']),
			),
			'files' => array(
				';class' => array($p['class']),
				';lib' => array($p['lib']),
			),
			'param' => array(
				';parameter' => '[defaultvalue], value2, value2 (A little help here)',
			),
		);		
		
	//	Start filling up the file
		$return = null;
		foreach($conf as $h2 => $section)
		{
		//	Title
			$return .= '['.$h2.']'.n;
		//	Loop through each section
			foreach($section as $key => $value)
			{			
				if (is_array($value)) for ($i=0; $i < count($value); $i++) $return .= t.$key.'[] = '.$value[$i].n;
				else $return .= t.$key.' = '.$value.n;
			}
		}
	//	Give back
		return $return;
	}

/**
 * returns the sample data
 *
 * @param  string  $sample the sample data
 * @return array   all of the exciting sample options
 * @access private
 */
	public function copy($param)
	{
		$source = CC_APP_ROOT.'/'.$param['source'];
		$dest = CC_APP_ROOT.'/'.$param['dest'];
		if (copydir($source, $dest))
		{
			$e = array(
				'What went well' => 'Your <dfn>'.$param['source'].' app</dfn> has been created from the <dfn>'.$param['dest'].' app</dfn>.',
			);
			sentinel::log('SUCCESS', $e);
		}
	}
}
?>