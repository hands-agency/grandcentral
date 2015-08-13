<header>
	<h1>Documentation</h1>
</header>
<div id="doc">
	
	<?php if (count($apps) > 1): ?>
	<nav class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<ul>
		<?php foreach($html as $app) : ?>
			<li><a href=""><?=$app['title']?></a></li>
		<?php endforeach ?>
		</ul>
	</nav>
	<?php endif ?>
	
	<div class="content <?php if (count($apps) > 1): ?>col-xs-12 col-sm-9 col-md-9 col-lg-9<?php endif ?>">
		<?php foreach($html as $app) : ?>
			<div class="padding">
			
				<h2><span class="flag"><?=$app['key']?></span><?=$app['title']?></h2>
			
				<div class="descr"><?=$app['descr']?></div>
				<?php if (isset($app['class'])): ?>		
				<h3>Classes</h3>
				<div class="section">
				<?php foreach($app['class'] as $key => $class) : ?>
					<h4><a href="?class=<?=$key?>#doc"><?=ucfirst($key)?></a></h4>
					<div class="descr"><?=$class['descr']?></div>
					<?php if (!empty($class['method'])): ?>
					<ul class="in2col">
					<?php foreach($class['method'] as $method) : ?><li><a href="<?=$docPage['url']?>?method=<?=$key?>::<?=$key?>#doc"><?=$method['key']?></a></li><?php endforeach ?>
					</ul>
					<?php endif ?>
				<?php endforeach ?>
				</div>
				<?php endif ?>

				<?php if (isset($app['lib'])): ?>		
				<h3>Libraires</h3>
				<div class="section">
					<?php foreach($app['lib'] as $lib => $functions) : ?>
						<h4><a href="?lib=<?=$lib?>#doc"><?=$lib?></a></h4>
						<ul class="in2col">
						<?php foreach($functions as $function) : ?><li><a href="<?=$docPage['url']?>?function=<?=$function?>#doc"><?=$function?></a></li><?php endforeach ?>
						</ul>
					<?php endforeach ?>
				</div>
				<?php endif ?>	

				<?php if (isset($app['routine'])): ?>
				<h3>Routines</h3>
				<div class="section">
					<?php foreach($app['routine'] as $routine) : ?>
						<h4><a href="?routine=<?=$routine?>#doc"><?=$routine?></a></h4>
					<?php endforeach ?>
				</div>
				<?php endif ?>
			</div>
		<?php endforeach ?>
	</div>
</div>