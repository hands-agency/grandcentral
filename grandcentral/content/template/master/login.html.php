<!DOCTYPE html>
<html lang="<?= i('version', current)->get_attr('key') ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<!-- ZONE:body -->
		
	<div id="main" class="navClosed adminClosed contextClosed">
			
		<nav id="grandCentralNav"><!-- ZONE:nav --></nav>
		
		<div id="grandCentralAdmin">
	
			<aside id="context">
				<button type="button" class="close"></button>
				<div><!-- Welcome Ajax --></div>
			</aside>

			<div id="content">
				<!-- ZONE:content|left -->
			</div>
			
		</div>
	
		<div id="grandCentralSite">
			<!-- ZONE:site|left -->
			<iframe src="<?=SITE_URL?>"></iframe>
		</div>
	</div>
	
	<!-- ZONE:script -->
</body>
</html>