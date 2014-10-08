<h1>Documentation</h1>
<nav>
	<ul>
	<? foreach($html as $app) : ?>
		<li><a href=""><?=$app['title']?></a></li>
	<? endforeach ?>
	</ul>
</nav>
<div class="content">
	<? foreach($html as $app) : ?>
		<div class="padding">
			
			<h2><span class="flag"><?=$app['key']?></span><?=$app['title']?></h2>
			
			<div class="descr"><?=$app['descr']?></div>
			<? if (isset($app['class'])): ?>		
			<h3>Classes</h3>
			<div class="section">
			<? foreach($app['class'] as $key => $class) : ?>
				<h4><a href="?class=<?=$key?>#doc"><?=ucfirst($key)?></a></h4>
				<div class="descr"><?=$class['descr']?></div>
				<?php if (!empty($class['method'])): ?>
				<ul class="in4col">
				<? foreach($class['method'] as $method) : ?><li><a href="?method=<?=$key?>::<?=$key?>#doc"><?=$method['key']?></a></li><? endforeach ?>
				</ul>
				<?php endif ?>
			<? endforeach ?>
			</div>
			<? endif ?>

			<? if (isset($app['lib'])): ?>		
			<h3>Libraires</h3>
			<div class="section">
				<? foreach($app['lib'] as $lib => $functions) : ?>
					<h4><a href="?lib=<?=$lib?>#doc"><?=$lib?></a></h4>
					<ul class="in4col">
					<? foreach($functions as $function) : ?><li><a href="?function=<?=$function?>#doc"><?=$function?></a></li><? endforeach ?>
					</ul>
				<? endforeach ?>
			</div>
			<? endif ?>	

			<? if (isset($app['routine'])): ?>
			<h3>Routines</h3>
			<div class="section">
				<? foreach($app['routine'] as $routine) : ?>
					<h4><a href="?routine=<?=$routine?>#doc"><?=$routine?></a></h4>
				<? endforeach ?>
			</div>
			<? endif ?>
		</div>
	<? endforeach ?>
</div>