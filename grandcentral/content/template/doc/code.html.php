<? foreach($html as $app) : ?>
	<h2><span class="flag"><?=$app['key']?></span><?=ucfirst($app['title'])?></h2>
	<div class="padding">
		<div class="descr"><?=$app['descr']?></div>

		<? if (isset($app['class'])): ?>		
			<h3>Classes</h3>
			<? foreach($app['class'] as $class) : ?>
				<h4><a href="?class=<?=$class['key']?>#doc"><?=ucfirst($class['key'])?></a></h4>
				<div class="descr"><?=$class['descr']?></div>
				<?php if (!empty($class['method'])): ?>
				<ul class="in4col">
				<? foreach($class['method'] as $method) : ?><li><a href="?method=<?=$class['key']?>::<?=$method['key']?>#doc"><?=$method['key']?></a></li><? endforeach ?>
				</ul>
				<?php endif ?>
			<? endforeach ?>
		<? endif ?>
	
		<? if (isset($app['lib'])): ?>		
			<h3>Libraires</h3>
			<? foreach($app['lib'] as $lib => $functions) : ?>
				<h4><a href="?lib=<?=$lib?>#doc"><?=$lib?></a></h4>
				<ul class="in4col">
				<? foreach($functions as $function) : ?><li><a href="?function=<?=$function?>#doc"><?=$function?></a></li><? endforeach ?>
				</ul>
			<? endforeach ?>
		<? endif ?>	
	
		<? if (isset($app['routine'])): ?>	
			<h3>Routines</h3>
			<? foreach($app['routine'] as $routine) : ?>
				<h4><a href="?routine=<?=$routine?>#doc"><?=$routine?></a></h4>
			<? endforeach ?>
		<? endif ?>		
	</div>
<? endforeach ?>