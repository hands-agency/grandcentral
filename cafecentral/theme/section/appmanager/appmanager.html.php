<ul id="appmanager" data-install="install" data-remove="remove">
<? foreach ($apps as $app) : ?>
	<li data-item="app_123">
		
		<div class="icon"></div>
		
		<? if ($app['installed'] === true) : ?>
		<div class="title"><a href="<?= $app['edit']; ?>"><?= $app['title']; ?></a></div>
		<div class="descr"><?= $app['descr']; ?></div>
		<ul class="action">
			<li><a href="">Comment</a></li>
			<li><a href="#" class="remove" data-key="<?= $app['key']; ?>">Desactivate</a></li>
			<? if (isset($app['url'])): ?><li><a href="<?= $app['url']; ?>" class="url">Visit website</a></li><? endif ?>
		</ul>
		<? else : ?>
		<div class="title"><?= $app['title']; ?></div>
		<ul class="action">
			<li><a href="" class="comment">Comment</a></li>
			<li><a href="#" class="install" data-key="<?= $app['key']; ?>">Activate</a></li>
		</ul>
		<? endif; ?>
		
		<ul class="comment"></ul>
	</li>
<? endforeach; ?>
</ul>
<div id="debugmanager"></div>