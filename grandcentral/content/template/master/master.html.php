<!DOCTYPE html>
<html lang="<?= i('version', current)->get_attr('key') ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<!-- ZONE:body -->
		
	<div id="main" class="navClosed contextClosed">
		
		<div id="grandCentralSite">
			<div class="overlay">
				<h1><?=i('site', current)['title']?></h1>
				<span data-batchicon="&#xF09B;"></span>
			</div>
		</div>

		<div id="grandCentralAdmin">
			
			<nav id="adminNav"><!-- ZONE:nav --></nav>
			
			<aside id="adminContext">
				<button type="button" class="close"></button>
				<div><!-- Welcome Ajax --></div>
			</aside>

			<div id="adminContent" class="locked inmasonry">
				<header><!-- ZONE:header --></header>
				<!-- ZONE:content|left -->
				<ul id="sectiontray" style="width:<?=$sectionTrayWidth?>">
					<? foreach($sections as $section) : ?>
					<? $app = $section['app'] ?>
					<? $greenbutton = ($section['greenbutton']->get()) ? i($section['greenbutton']->get()[0])->json() : null ?>
					<? /* cst('GREENBUTTON_SECTION_NEW_TITLE') */ ?>
					<li style="width:<?=$sectionWidth?>"><section id="section_<?= $section['key'] ?>" class="virgin" data-app="<?= $app['key'] ?>" data-template="<?= $app['template'] ?>" data-greenbutton='<?= $greenbutton ?>'></section></li>
					<? endforeach; ?>
				</ul>
				<footer><!-- ZONE:footer --></footer>
			</div>
			
		</div>
	</div>
	
	<!-- ZONE:script -->
</body>
</html>