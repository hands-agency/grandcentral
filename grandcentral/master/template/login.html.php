<!DOCTYPE html>
<html lang="<?= cc('version', current)->get_attr('key'); ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<div id="popup_overlay">
		
	</div>
	<!-- ZONE:body -->

		<iframe id="site" src="<?=SITE_URL?>"></iframe>
		<iframe id="admin" src="" data-src="<?=ADMIN_URL?>?target=_parent"></iframe>
		
		<div id="content">
			<!-- ZONE:content -->
		</div>
	<!-- ZONE:script -->	
</body>
</html>