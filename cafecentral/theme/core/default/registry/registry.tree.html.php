<?php
	$tree = registry::$admin;
	$tree['user'] = $_SESSION['user'];
	$tree['user']['site'] = registry::$site;
	$tree['user']['site']['version'] = registry::$version;
	$tree['user']['site']['version']['page'] = registry::$page;
	$tree['user']['site']['version']['page']['child'] = registry::$child;
	
	sentinel::debug('The Great Tree of Life in '.__FILE__.' line '.__LINE__, $tree);
?>
