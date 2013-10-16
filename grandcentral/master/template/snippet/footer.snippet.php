<ul id="mnsys">
	<?php foreach ($page as $page): ?>
		<li><a href="<?=$page['url']?>" title="<?=$page['title']?>"><?=$page['title']?></a></li>
	<?php endforeach ?>
	<li>Env: <a href="/admin?env=site" title="Help">Site</a> / <a href="/admin?env=admin" title="Help">Admin</a></li>
</ul>
<ul id="mnflags">
	<li>Served at <a href="en" title="About my release">Bonaparte</a> in <a href="en" title="More benchmark intel"><?=sentinel::stopwatch().'s ('.database::query_count().' queries), using '.sentinel::memoryusage()?></a></li></a></li>
</ul>