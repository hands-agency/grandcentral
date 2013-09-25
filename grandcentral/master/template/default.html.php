<!DOCTYPE html>
<html lang="">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<!-- ZONE:body -->
	<div id="site"><iframe src=""></iframe></div>
	<div id="admin">
		<!-- ZONE:navcc -->
		
		<header>
			<div class="responsive-width">
				<!-- ZONE:header -->
			</div>
		</header>
		
		<div id="tabs">
			<div class="responsive-width">
				<!-- ZONE:tabs -->
			</div>
		</div>
		
		<div id="main" role="main" class="in2col">
			<div class="responsive-width">
	
				<div id="content" class="locked instack">
					<!-- ZONE:content|left -->
				</div>
			
				<div id="contextwrapper">
					<div id="context">
						<!-- ZONE:context|right -->
						<div class="clear"><!-- Clearing floats --></div>
					</div>
				</div>
				<div class="clear"><!-- Clearing floats --></div>
			</div>
		</div>
		
		<footer>
			<div class="responsive-width">
				<!-- ZONE:footer -->
			</div>
		</footer>
		<!-- ZONE:script -->
	</div>
</body>
</html>