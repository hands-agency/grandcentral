<!DOCTYPE html>
<html>
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body>
	<?php
		
//	For readers, also create the zones for the list & detail sections
	if ($section['app']['app'] == 'reader')
	{
		$list = i($section['app']['param']['list']);
	
		echo '<!-- ZONE:'.$list['zone'].' -->';
//		echo '<!-- ZONE:content -->';
	}
//	Change the zone to a dummy section
	else
	{
		$section['zone'] = 'dummy';
		echo '<!-- ZONE:dummy -->';
	}
	
	?>
	<?=$section?>
	<!-- ZONE:script -->
</body>
</html>