<?php if (isset($item)) : ?>
<section>
	<div class="thumbnail medium">
		<iframe src="<?=$item['url']; ?>"></iframe>
		<a class="thumbnailPlaceholder" href="<?=$item['url'];?>"></a>
	</div>
</section>
<?php endif ?>