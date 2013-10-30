<?php
/********************************************************************************************/
//	admin bar
/********************************************************************************************/
	$_ZONE = $_PARAM['zone'];
	
	for ($i=0, $count = count($_ZONE['data']); $i < $count; $i++)
	{ 
		$data = $_ZONE['data'][$i];
		if ($data['type'] == 'file' && filter_var($data['url'], FILTER_VALIDATE_URL) === false)
		{
			$file = new file($data['url']);
			$_ZONE['data'][$i]['url'] = $file->get_url();
		}
	}
?>

