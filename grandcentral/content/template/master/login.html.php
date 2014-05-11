<!DOCTYPE html>
<html lang="<?= i('version', current)->get_attr('key') ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<? $_SESSION['pref']['handled_env']?>">
	<!-- ZONE:body -->
		
	<div id="main" class="siteOpened">

	
		<div id="grandCentralSite">
			<!-- ZONE:site|left -->
			<iframe src="<?=SITE_URL?>"></iframe>
		</div>
		
		<div id="grandCentralAdmin">


			<div id="adminContent">
				<!-- ZONE:content|left -->
			</div>
			
		</div>
	</div>
	
	<!-- ZONE:script -->
</body>
</html>