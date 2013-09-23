<?php
	$bunch = new bunch('admin');
	$bunch->get('app');
	
	$_VIEW->bind('script', '/jquery_carousel.js');
	$_VIEW->bind('css', '/jquery_carousel.css');
?>

<div class="carousel_vertical">
<ul>
	<?php foreach ($bunch as $app) : ?>
	<li>
		<div class="ico"></div>
		<div class="key"><?= $app['key'] ?></div>
		<div class="title"><?= $app['title'] ?></div>
	</li>
	<?php endforeach; ?>
</ul>
</div>
