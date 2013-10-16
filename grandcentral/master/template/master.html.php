<!DOCTYPE html>
<html lang="<?= cc('version', current)->get_attr('key') ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<!-- ZONE:body -->
		
	<div id="main" class="navClosed contextClosed">
			
		<nav id="grandCentralNav"><!-- ZONE:nav --></nav>
		
		<div id="grandCentralAdmin">
	
			<aside id="context">
				<button type="button" class="close"></button>
				<div><!-- Welcome Ajax --></div>
			</aside>

			<div id="content" class="locked instack">
				<button type="button" class="close"></button>
				<header><!-- ZONE:header --></header>
				<div id="tabs"><!-- ZONE:tabs --></div>
				<!-- ZONE:content|left -->
				<? foreach($_PAGE['section']->unfold() as $section) : ?>
				<? $app = $section['app'] ?>
				<? $greenbutton = ($section['greenbutton']->get()) ? cc($section['greenbutton']->get()[0])->json() : null ?>
				<section id="section_<?= $section['key'] ?>" data-app="<?= $app['key'] ?>" data-template="<?= $app['template'] ?>" data-greenbutton='<?= $greenbutton ?>'></section>
				<? endforeach; ?>
				<footer><!-- ZONE:footer --></footer>
			</div>
			
		</div>
	
		<div id="grandCentralSite">
			<div class="overlay"><span data-icon="&#xe013;"></span></div>
		</div>
	</div>
	
	<!-- ZONE:script -->
</body>
</html>