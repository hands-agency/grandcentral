<ul id="appmanager" data-install="install" data-remove="remove">
<?php foreach ($apps as $app) : ?>
	<li data-item="app_123">
		
		<div class="icon"></div>
		
		<?php if ($app['installed'] === true) : ?>
		<div class="title"><a href="<?= $app['edit']; ?>"><?= $app['title']; ?></a></div>
		<div class="descr"><?= $app['descr']; ?></div>
		<ul class="action">
			<li><a href="">Comment</a></li>
			<li><a href="#" class="remove" data-key="<?= $app['key']; ?>">Desactivate</a></li>
			<?php if (isset($app['url'])): ?><li><a href="<?= $app['url']; ?>" class="url">Visit website</a></li><?php endif ?>
		</ul>
		<?php else : ?>
		<div class="title"><?= $app['title']; ?></div>
		<ul class="action">
			<li><a href="" class="comment">Comment</a></li>
			<li><a href="#" class="install" data-key="<?= $app['key']; ?>">Activate</a></li>
		</ul>
		<?php endif; ?>
		
		<ul class="comment"></ul>
	</li>
<?php endforeach; ?>
</ul>
<div id="debugmanager"></div>