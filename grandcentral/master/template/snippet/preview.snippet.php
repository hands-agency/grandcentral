<? if (isset($item)) : ?>
<section>
	<div class="thumbnail medium">
		<iframe src="<?=$item->link(); ?>"></iframe>
		<a class="thumbnailPlaceholder" href="<?=$item->link();?>"></a>
	</div>
</section>
<? endif ?>