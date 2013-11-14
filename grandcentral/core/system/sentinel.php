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
 * @copyright	Copyright © 2004-2013, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class sentinel
{
//	Singleton
	private static $instance = null;
//	Store the stopwatch data
	private static $stopwatch = array();
//	chemin du fichier log
	private $log = '/log/sentinel.log';
//	Load the css of the debug panel only once
	private static $debugcss = false;
//	Load the css of the debug panel only once
	private static $oldError = null;

/**
 * Class constructor: catches PHP exceptions and errors
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	private function __construct()
	{
	//	si l'affichage des erreurs est désactivé
		if(SITE_DEBUG === false)
		{
			ini_set("display_errors", 0);
		}
		else
		{
			ini_set("error_reporting", 'E_ALL');
		}
		self::startwatch();
		$this->log = ROOT.$this->log;
		set_error_handler(array($this,'error_handler'));
		set_exception_handler(array($this,'exception_handler'));
	}

/**
 * Create only one instance of the Sentinel
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public static function getInstance()
	{
		if(is_null(self::$instance))
		{
			self::$instance = new sentinel();
		}
		return self::$instance;
	}

/**
 * Log an error
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public static function log($type, $param)
	{
	//	par défaut, le script continuera de tourner
		$die = false;
		$trace = true;
	//	sinon, on détermine le type
		switch($type)
		{
		//	success
			case 'SUCCESS':
				$type = 'Success';
				break;
		//	debug
			case 'DEBUG':
				$type = 'Debug';
				break;
		//	notice
			case 8:
	        case E_NOTICE:
			case E_USER_NOTICE:
				$type = 'Notice';
				$trace = false;
				break;
      	//	warning
	        case E_WARNING:
			case E_USER_WARNING:
				$type = 'Warning';
				$trace = false;
				break;
		//	Strict
			case 2048:
	        case E_STRICT:
				$type = 'Strict';
				break;
		//	fatal
			case 4096:
			case E_ERROR:
	        case E_USER_ERROR:
				$type = 'Error';
				$die = true;
				break;
		//	Autre
			default:
				$type = 'unknown';
				break;
		}
	//	Add the trace
		if ($trace === true)
		{
		//	vider le précédent tampon
			// ob_end_clean();
		//	afficher l'erreur
			ob_start();
			debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			// print '<pre style="width:2000px">';print_r(debug_backtrace());print'</pre>';
			$trace = ob_get_contents();
			ob_end_clean();
			$param['trace'] = '<pre>'.print_r($trace, true).'</pre>';
		}
	//	Write down the error
		$error = null;
		foreach($param as $key => $value) $error.= '<li><strong>'.$key.'</strong> : '.$value.'</li>';
		
	//	Throw error
		sentinel::debug($type, $error, $type);
	//	...end perhaps kill the script
		if ($die === true) die();
	}

/**
 * Fetch and format PHP errors
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public function error_handler($Ftype, $Fmsg, $Ffile, $Fline, $Fcontext)
    {
        $param = array(
			'What went wrong' => $Fmsg,
			'file' => $Ffile,
			'line' => $Fline
		);
		$this->log($Ftype, $param);
        return true;
    }

/**
 * Fetch and format PHP exceptions
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public function exception_handler($e)
    {
		// print '<pre>';print_r($e);print'</pre>';
		$param = array(
			'What went wrong' => $e->getMessage()
		);
		$this->log(E_WARNING, $param);
    }

/**
 * Prints a Debug
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public static function debug($title, $descr, $flag = 'debug')
	{
	//	A little bit of fancy styling
		if (!self::$debugcss)
		{
			$css = '
			<style type="text/css" media="screen">
				.cc-sentinel 
				{
					position: relative;
					-moz-border-radius: 3px;
					border-radius: 3px;
					color: rgba(0,0,0, .8);
					text-shadow: 0 1px 0 #fff;
					border: 3px solid #EEEEEE;
					margin:50px auto;
					max-width:600px;
					position: relative;
					background:#ffffff	
				}
				.cc-sentinel dfn
				{
					border-bottom:1px dotted #999999;
					font-style:normal;
				}
				.cc-sentinel dfn:hover
				{
					color:#FFFFFF;
				}
				
				/* Shadow */
				.cc-sentinel:before, .cc-sentinel:after 
				{
					z-index: -1; 
					position: absolute; 
					content: "";
					bottom: 15px;
					left: 10px;
					width: 50%; 
					top: 80%;
					max-width:300px;
					background: rgba(0, 0, 0, 0.7); 
					-webkit-box-shadow: 0 15px 10px rgba(0,0,0, 0.5);   
					-moz-box-shadow: 0 15px 10px rgba(0, 0, 0, 0.5);
					box-shadow: 0 15px 10px rgba(0, 0, 0, 0.5);
					-webkit-transform: rotate(-3deg);    
					-moz-transform: rotate(-3deg);   
					-o-transform: rotate(-3deg);
					-ms-transform: rotate(-3deg);
					transform: rotate(-3deg);
				}
				.cc-sentinel:after 
				{
				  -webkit-transform: rotate(3deg);
				  -moz-transform: rotate(3deg);
				  -o-transform: rotate(3deg);
				  -ms-transform: rotate(3deg);
				  transform: rotate(3deg);
				  right: 10px;
				  left: auto;
				}
				
				/* Ribbon */
				.cc-sentinel-ribbon-wrapper {
					width: 85px;
					height: 88px;
					overflow: hidden;
					position: absolute;
					top: -3px;
					right: -3px;
				}
				.cc-sentinel-ribbon {
					text-transform:uppercase;
					color: #333;
					text-align: center;
					text-shadow: rgba(255,255,255,0.5) 0px 1px 0px;
					-webkit-transform: rotate(45deg);
					-moz-transform:    rotate(45deg);
					-ms-transform:     rotate(45deg);
					-o-transform:      rotate(45deg);
					position: relative;
					padding: 7px 0;
					left: -5px;
					top: 15px;
					width: 120px;
					color: #6a6340;
					-webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.3);
					-moz-box-shadow:    0px 0px 3px rgba(0,0,0,0.3);
					box-shadow:         0px 0px 3px rgba(0,0,0,0.3);
				}
				
				.cc-sentinel-ribbon:before {
					left: 0;
				}
				.cc-sentinel-ribbon:after {
					right: 0;
				}
				
				/* Colours */
				.cc-sentinel-ribbon.debug
				{
					background-color: #BFDC7A;
					background-image: -webkit-gradient(linear, left top, left bottom, from(#BFDC7A), to(#8EBF45));
					background-image: -webkit-linear-gradient(top, #BFDC7A, #8EBF45);
					background-image:    -moz-linear-gradient(top, #BFDC7A, #8EBF45);
					background-image:     -ms-linear-gradient(top, #BFDC7A, #8EBF45);
					background-image:      -o-linear-gradient(top, #BFDC7A, #8EBF45);
				}
				.cc-sentinel-ribbon.notice
				{
					background:#FFD500;
				}
				.cc-sentinel-ribbon.warning,
				.cc-sentinel-ribbon.strict
				{
					background:#FFC000;
				}
				.cc-sentinel-ribbon.error
				{
					background:#FF0000;
				}
				.cc-sentinel-ribbon:before,
				.cc-sentinel-ribbon:after {
					content: "";
					border-top:   3px solid #888888;   
					border-left:  3px solid transparent;
					border-right: 3px solid transparent;
					position:absolute;
					bottom: -3px;
				}

				/* Lines */
				.cc-sentinel-title
				{
					font-size:12px;
					padding:10px;
					border-bottom:1px solid #dddddd;
					background-image: -moz-linear-gradient(top, #FFFFFF 0%, #EEEEEE 100%);
				}
				.cc-sentinel-descr
				{
					padding:30px 50px;
					font-size:12px;
					white-space:pre-wrap;
					background:#f9f9f9;
					margin:1px
				}
				.cc-sentinel-descr pre
				{
					white-space:pre-wrap;
					color:#999;
					margin: 10px 0 0 0;
					padding: 0 0 0 10px;
					border-left:1px solid #eee
				}
			</style>';
		//	We're good once and for all
			self::$debugcss = true;
		}
		
	//	Print the debug
		if (isset($css)) echo $css;
		echo '
		<div class="cc-sentinel">
			<div class="cc-sentinel-ribbon-wrapper">
				<div class="cc-sentinel-ribbon '.strtolower($flag).'">'.$flag.'</div>
			</div>
			<div class="cc-sentinel-title">'.$title.'</div>
			<pre class="cc-sentinel-descr">'.print_r($descr, true).'</pre>
		</div>';
	}

/**
 * Start a new stopwatch
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public static function startwatch()
	{
	//	Compter
		$mtime = microtime(); 
		$mtime = explode(' ', $mtime);
	//	Plusieurs chronos peuvent cohabiter. En ouvrir un nouveau
		self::$stopwatch[] = $mtime[1] + $mtime[0];
	}

/**
 * Stop the last instance of a stopwatch
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public static function stopwatch()
	{
		$mtime = explode(' ', microtime());
		$end = $mtime[1] + $mtime[0];
		$start = self::$stopwatch[(count(self::$stopwatch)-1)];
	//	Return
		return round(($end-$start), 4);
	}

/**
 * Get the memory usage of PHP (in Mo)
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public static function memoryusage()
	{
		return round(memory_get_usage(true)/1024/1024, 2).'M / '.ini_get('memory_limit');
	}
}
?>