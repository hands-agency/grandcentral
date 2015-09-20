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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$apps = registry::get(registry::app_index);
	$app = $_POST['app'];
	$path = ADMIN_ROOT.'/'.$app['key'];
	$content = '';
	
/********************************************************************************************/
//	Let's get to work
/********************************************************************************************/
//	Check if this app does not already exist
	if (isset($apps[$app['key']]))
	{
		$return = array(
			'meta' => array
			(
				'status' => 'fail',
				'msg' => 'Sorry, there\'s already an app called '.$app['key'],
			),
		);
	}
//	Let's get started
	else
	{
	//	Create the folder
		if (!file_exists($path))
		{
			mkdir($path, 0777, true);
			mkdir($path.'/system', 0777, true);
			mkdir($path.'/template', 0777, true);
		}
	//	Create the config.ini
		$file = $path.'/config.ini';
		foreach ($app as $section => $array)
		{
		//	A section
			if (is_array($array))
			{
				foreach ($array as $key => $value)
				{
				//	Changing section
					if (!isset($currentSection) OR $section != $currentSection) $content .= "[".$section."]\n";
				//	Store value
					if (isset($value))
					{
						if (is_array())
						{
							# code...
						}
					}
				//	Remember section
					$currentSection = $section;
				}
			}
		}
	//	Add to the file
		file_put_contents($file, $content);
		
	//	$app['git'] = 'https://api.github.com/repos/hands-agency/grandcentral/zipball';
		
	//	Fetch from a Git Hub Repo
		if (isset($app['git']))
		{
			file_put_contents($path.'/temp/master.zip',
				file_get_contents($app['git'])
			);
			$zip = new ZipArchive();
			if ($zip->open($newfile, ZIPARCHIVE::CREATE)!==TRUE)
			{
				exit("cannot open <$filename>\n");
			}
			$zip->extractTo($path.'/unzip');
			$zip->close();
		}
	
	//	Return
		$return = array(
			'meta' => array
			(
				'status' => 'built',
				'path' => $path,
			),
			'data' => $app,
		);
	}

/********************************************************************************************/
//	Return
/********************************************************************************************/
	echo json_encode($return);
?>