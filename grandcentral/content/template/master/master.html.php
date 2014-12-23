<!DOCTYPE html>
<html lang="<?= i('admin', current)['version']['key'] ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	
	<!-- ZONE:body -->
		
	<div id="main" class="navClosed contextClosed">
			
		<button id="openNav" data-feathericon="&#xe120"></button>
		<button id="closeNav" data-feathericon="&#xe117"></button>
		
		<button id="switchEnv" data-feathericon="&#xe032"></button>
	
		<div id="alert">
			<div class="icon" data-feathericon="&#xe064"></div>
			<div class="info">				
				<div class="response"></div>
				<div class="help">Tap to close</div>
			</div>
		</div>
		
		<div id="nav"></div>
				
		<header>
			<div class="site"><!-- ZONE:headersite --></div>
			<div class="admin"><!-- ZONE:headeradmin --></div>
		</header>
		
		<div id="grandCentralSite">
			<iframe></iframe>
		</div>

		<div id="grandCentralAdmin">

			<div id="adminContent" class="locked">
				<!-- ZONE:content|left -->
				<div id="currentItem"></div>
				<ul id="sectiontray" style="width:<?=$sectionTrayWidth?>">
					<? foreach($sections as $section) : ?>
					<? $app = $section['app'] ?>
					<? $prefDisplay = isset($_SESSION['user']['pref'][$section['key']->get()]['display']) ? $_SESSION['user']['pref'][$section['key']]['display'] : 'inmasonry' ?>
					<? $greenbutton = ($section['greenbutton']->get()) ? htmlspecialchars(i($section['greenbutton']->get()[0])->json(), ENT_QUOTES) : null ?>
					<li style="width:<?=$sectionWidth?>">
						<span class="lock" data-feathericon="&#xe007"></span>
						<section id="section_<?= $section['key'] ?>" class="virgin" data-pref-display="<?=$prefDisplay?>" data-app="<?= $app['app'] ?>" data-template="<?= $app['template'] ?>" data-greenbutton='<?= $greenbutton ?>' data-nodata="<?=$section['nodata']?>"></section>
					</li>
					<? endforeach; ?>
				</ul>
				<footer><!-- ZONE:footer --></footer>
			</div>
			
			<aside id="adminContext">
				<button type="button" class="close"></button>
				<div><!-- Welcome Ajax --></div>
			</aside>
						
		</div>
	</div>
	
	<!-- ZONE:script -->
</body>
</html>