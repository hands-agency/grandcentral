<div data-nodata="Sorry, Google can't see this item at all"><?php if (isset($item['url'])): ?>
<ul>
	<li class="false">
		<div class="title"><a><?=$lorem->cut(65)?></a></div>
		<div class="url"><a href="">http://www.lorem.com/ipsum/sit</a></div>
		<div class="descr"><a><?=$lorem->cut(155)?></a></div>
	</li>
	<li class="true">
		<div class="title"><a href="javascript:takemeto(\'titre\');"><?=$item['title']->cut(65)?></a></div>
		<div class="url"><a href="javascript:takemeto(\'urlr\');"><?=$item['url']?></a></div>
		<div class="descr"><a href="javascript:takemeto(\'chapo\');"><?=$item['descr']->cut(65)?></a></div>
	</li>
	<li class="false">
		<div class="title"><a><?=$lorem->cut(65)?></a></div>
		<div class="url"><a href="">http://www.lorem.com/ipsum/sit</a></div>
		<div class="descr"><a><?=$lorem->cut(155)?></a></div>
	</li>
	<li class="false">
		<div class="title"><a><?=$lorem->cut(65)?></a></div>
		<div class="url"><a href="">http://www.lorem.com/ipsum/sit</a></div>
		<div class="descr"><a><?=$lorem->cut(155)?></a></div>
	</li>
	<li class="false">
		<div class="title"><a><?=$lorem->cut(65)?></a></div>
		<div class="url"><a href="">http://www.lorem.com/ipsum/sit</a></div>
		<div class="descr"><a><?=$lorem->cut(155)?></a></div>
	</li>
</ul>
<?php endif ?></div>