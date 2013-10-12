<!DOCTYPE html>
<html lang="<?= cc('version', current)->get_attr('key') ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<!-- ZONE:body -->
		
	<div id="main" class="navClosed">
			
		<nav id="grandCentralNav"><!-- ZONE:nav --></nav>
		
		<div id="grandCentralAdmin" class="in2col">
		
			<button type="button" class="close"></button>
			
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
				<? $greenbutton = $section['greenbutton']->unfold()->json() ?>
				<section id="section_<?= $section['key'] ?>" data-app="<?= $app['key'] ?>" data-template="<?= $app['template'] ?>" data-greenbutton='<?= $greenbutton ?>'></section>
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
	
		<div id="grandCentralSite">
			<div class="overlay"><span data-icon="&#xe013;"></span></div>
		</div>
	</div>
	
	<!-- ZONE:script -->
</body>
</html>