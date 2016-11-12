<?php
/**
 * Error and exception handling.
 * This class is a singleton.
 *
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
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
 * @access	private
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
			ini_set("display_errors", 1);
			ini_set("error_reporting", 'E_ALL');
		}
		self::startwatch();
		$this->log = ROOT.$this->log;
		register_shutdown_function(array($this,'error_shutdown'));
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
			case 2:
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
		//	Strict
			case 4:
	        case E_PARSE:
				$type = 'Parse';
				$die = true;
				$trace = false;
				break;
		//	fatal
			case 1:
			case 4096:
			case E_ERROR:
	        case E_USER_ERROR:
				$type = 'Error';
				$die = true;
				break;
		//	Autre
			case 0:

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
		if (SITE_DEBUG === true) sentinel::debug($type, $error, $type);
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
 * Fetch and format PHP exceptions
 *
 * @param	string  $sample the sample data
 * @author	mvd@cafecentral.fr
 * @return	array	all of the exciting sample options
 * @access	public
 */
	public function error_shutdown()
    {
		$error = error_get_last();

		if (!is_null($error))
		{
			$param = array(
				'What went wrong' => $error['message'],
				'file' => $error['file'],
				'line' => $error['line']
			);
			$this->log($error['type'], $param);
		}
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

	//	Display varies depending on content type
		$contentType = class_exists('master', false) ? master::get_content_type() : '';

		switch ($contentType)
		{
			//	Json
			case 'json':
				echo $flag.": ".$title."\n(".print_r($descr, true).")";
				break;

			//	HTML & more
			case 'html':
			//	A little bit of fancy styling
				if (!self::$debugcss)
				{
					$css = '
					<style type="text/css">
						.gc-sentinel
						{
							position: relative;
							-moz-border-radius: 2px;
							border-radius: 2px;
							margin:50px;
							position: relative;
							background:#f9f9f9;
							font-family:"HelveticaNeue", helvetica, arial, "Lucida Grande", Geneva, Verdana, sans-serif;
							-webkit-box-shadow: 0px 1px 1px 0px rgba(50, 50, 50, 0.4);
							-moz-box-shadow:    0px 1px 1px 0px rgba(50, 50, 50, 0.4);
							box-shadow:         0px 1px 1px 0px rgba(50, 50, 50, 0.4);
							display: table;
						}
						.gc-sentinel:after
						{
							position:absolute;
							top:10px;
							right:10px;
							content:"×";
							color:rgba(0, 0, 0, 0.2);
							cursor:pointer;
						}
						.gc-sentinel:after:hover
						{
							color:rgba(0, 0, 0, 1);
						}
						.gc-sentinel dfn
						{
							border-bottom:1px dotted #999999;
							font-style:normal;
						}
						.gc-sentinel dfn:hover
						{
							color:#FFFFFF;
						}

						/* Flag */
						.gc-sentinel-flag {
							width:60px;
							height:140px;
							display: table-cell;
							margin:0 40px 0 0;
							background:#000;
							padding:10px;
							color:#fff;
							text-align:center;
							position:relative;
						}
						.gc-sentinel-flag:before{
							position:absolute;
							top:50%;
							left:50%;
							color:#fff;
							width:50px;
							height:50px;
							background:rgba(0, 0, 0, 0.2);
							margin:-25px 0 0 -25px;
							border-radius:50%;
							font-size:30px;
							line-height:50px;
							font-weight:bold;
						}

						/* Colours */
						.gc-sentinel-flag.ok
						{
							background:#01B255;
							color:#01B255;
						}

						.gc-sentinel-flag.debug
						{
							background:#1B44B2;
							color:#1B44B2;
						}

						.gc-sentinel-flag.notice
						{
							background:#FFD059;
							color:#FFD059;
						}

						.gc-sentinel-flag.warning,
						.gc-sentinel-flag.strict
						{
							color:#FFD500;
						}

						.gc-sentinel-flag.parse
						{
							background:#FFD059;
							color:#FFD059;
						}
						.gc-sentinel-flag.parse:after
						{
							content:"?"
						}

						.gc-sentinel-flag.error
						{
							background:#FF1A02;
							color:#FF1A02;
						}
						.gc-sentinel-flag.error:after
						{
							content:"!"
						}

						/* Lines */
						.gc-sentinel-title
						{
							font-size:16px;
							padding:30px 30px 10px 30px;
							font-weight:bold;
						}
						.gc-sentinel-descr
						{
							padding:0 30px 30px 30px;
							font-size:12px;
							white-space:pre-wrap;
							margin:0;
						}
						.gc-sentinel-descr pre
						{
							white-space:pre-wrap;
							color:#999;
							margin: 10px 0 0 0px;
							padding: 5px 0 5px 10px;
							border-left:1px solid #ccc
						}
					</style>';
				//	We're good once and for all
					self::$debugcss = true;
				}
			//	Icons
				$icon = array(
					'ok' => '116',
					'debug' => '076',
					'notice' => '006',
					'warning' => '117',
					'strict' => '117',
					'parse' => '117',
					'error' => '117',
				);

			//	Print the debug
				if (isset($css)) echo $css;
				echo '
				<div class="gc-sentinel">
					<div class="gc-sentinel-flag '.$flag.'" data-feathericon="&#xe'.$icon[strtolower($flag)].'"></div>
					<div class="gc-sentinel-title">'.$title.'</div>
					<div class="gc-sentinel-descr">'.print_r($descr, true).'</div>
				</div>';
				break;
			//	Default
			default:
				echo $flag.': '.$title.' ('.$descr.')';
				break;
		}

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
