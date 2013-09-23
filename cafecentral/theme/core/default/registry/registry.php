<?php
	$registry = registry::get();
	$data = null;
	foreach ($registry as $key => $value)
	{
		if (!is_array($value) && !is_object($value)) $data['_'][$key] = $value;
		else $data[$key] = $value;
	}
	
	$_VIEW->bind('css', '/registry.css');
	$_VIEW->bind('script', '/registry.js');
?>
