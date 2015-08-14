<!DOCTYPE html>
<html lang="<?= i('admin', current, 'admin')['version']['key'] ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	
	<!-- ZONE:body -->
		
	<div id="main" class="navClosed">
			
		<button id="openNav" data-feathericon="&#xe120"></button>
		<button id="closeNav" data-feathericon="&#xe117"></button>
		
		<button id="switchEnv" data-feathericon="&#xe000"></button>
	
		<div id="alert">
			<div class="icon"></div>
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
			<iframe id="siteContent"></iframe>
		</div>

		<div id="grandCentralAdmin">

			<div id="adminContent" class="locked">
				<!-- ZONE:content -->
				<div id="currentList"></div>
				<div id="currentItem"></div>
				
				<div id="sectiontray">
					<?php foreach($sections as $section) : ?>
					<?php $app = $section['app'] ?>
					<?php $prefDisplay = isset($_SESSION['user']['pref'][$section['key']->get()]['display']) ? $_SESSION['user']['pref'][$section['key']]['display'] : 'incard' ?>
					<?php
						$dataCallback = null;
						$callback = null;

					//	Take greenbutton from pref...
						if (isset($_SESSION['user']['pref']['greenbutton'][$section['key']->get()]))
						{
							$pref = $_SESSION['user']['pref']['greenbutton'][$section['key']->get()];
						//	Get a possible callback (like "back" or "reach")
							if (strstr($pref, '_')) 
								list($action, $callback) = explode('_', $pref);
							else $action = $pref;
						//	Get the main action
							$greenbutton = i('greenbutton', $action, 'admin');
						//	Add the callback
							if ($callback) $dataCallback = 'data-callback="'.$callback.'"';
						}
					//	Or use the first one
						else if ($section['greenbutton']->get())
						{
							$greenbutton = i($section['greenbutton']->get()[0], null, 'admin');
						}
						else $greenbutton = null;
					//	Jsonize
						if ($greenbutton) $greenbutton = htmlspecialchars($greenbutton->json(), ENT_QUOTES)
					?>
					<div>
						<a class="back" href="<?=$back?>" data-feathericon="&#xe094"></a>
						<span class="lock" data-feathericon="&#xe007"></span>
						<section id="section_<?= $section['key'] ?>" class="virgin" data-key="<?= $section['key'] ?>" <?=$dataCallback?> data-pref-display="<?=$prefDisplay?>" data-app="<?= $app['app'] ?>" data-template="<?= $app['template'] ?>" data-greenbutton='<?= $greenbutton ?>' data-nodata="<?=$section['nodata']?>"></section>
					</div>
					<?php endforeach; ?>
				</div>
				
				<footer><!-- ZONE:footer --></footer>
			</div>
			
			<!-- <aside> adminContext will be appended here -->
						
		</div>
	</div>
	
	<!-- ZONE:script -->
</body>
</html>