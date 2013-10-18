<!DOCTYPE html>
<html lang="<?= cc('version', current)->get_attr('key') ?>">
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
			<div class="overlay"><span data-icon="&#xe013;"></span></div>
		</div>
	</div>
	
	<!-- ZONE:script -->
</body>
</html>