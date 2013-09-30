<!DOCTYPE html>
<html lang="<?= cc('version', current)->get_attr('key') ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<!-- ZONE:body -->
	<div id="site"><iframe src=""></iframe></div>
	<div id="admin">
		<!-- ZONE:nav -->
		
		<div id="main" role="main" class="in2col">
			
			<header>
				<!-- ZONE:header -->
			</header>
				
			<div id="tabs">
				<!-- ZONE:tabs -->
			</div>

			<div id="content" class="locked instack">
				<!-- ZONE:content|left -->
				<? foreach($_PAGE['section']->unfold() as $section) : ?>
				<? $app = $section['app'] ?>
				<section id="section_<?= $section['key'] ?>" data-app="<?= $app['key'] ?>" data-template="<?= $app['template'] ?>" data-greenbuttonaction='<?= $section['greenbuttonaction'] ?>'></section>
				<? endforeach; ?>
			</div>
		
			<div id="contextwrapper">
				<div id="context">
					<!-- ZONE:context|right -->
					<div class="clear"><!-- Clearing floats --></div>
				</div>
			</div>
			
			<footer>
				<!-- ZONE:footer -->
			</footer>
		</div>
		
		<!-- ZONE:script -->
	</div>
</body>
</html>