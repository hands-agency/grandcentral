<?php foreach ($_ZONE['data'] as $script): ?>
	<?php if ($script['type'] == 'file'):
		$file = new file($script['url']);
	?>
	<script src="<?= $file->get_url(); ?>" type="text/javascript" charset="utf-8"></script>
	<?php else: ?>
	<script type="text/javascript" charset="utf-8">
		<?= $script['data']; ?>
	</script>
	<?php endif ?>
<?php endforeach ?>
