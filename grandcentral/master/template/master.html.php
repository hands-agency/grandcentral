<!DOCTYPE html>
<html lang="<?= cc('version', current)->get_attr('key'); ?>">
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
				<?= $f; ?>
				<!-- ZONE:content|left -->
				<? if ($sections) : foreach($sections as $section) : ?>
				<? $template = $section['template'] ?>
				<section id="section_<?= $section['key']; ?>" class="<?= $template['theme']; ?>" data-theme="<?= $template['theme']; ?>" data-template="<?= $template['template']; ?>" <?= $section->get_customdata(); ?> data-greenbuttonaction='<?= $section['greenbuttonaction']; ?>'></section>
				<? endforeach; endif; ?>
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