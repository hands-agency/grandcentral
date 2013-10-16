<!DOCTYPE html>
<html lang="<?= cc('version', current)->get_attr('key'); ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<!-- ZONE:body -->
		
	<div id="main" class="navClosed adminClosed">
			
		<nav id="grandCentralNav"><!-- ZONE:nav --></nav>
		
		<div id="grandCentralAdmin" class="in2col">
		
			<button type="button" class="close"></button>

			<div id="content" class="locked instack">
				<!-- ZONE:content -->
			</div>
		</div>
	
		<div id="grandCentralSite">
			<div class="overlay"><span data-icon="&#xe013;"></span></div>
		</div>
	</div>
	
	<!-- ZONE:script -->	
</body>
</html>