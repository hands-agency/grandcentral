<?php foreach ($_ZONE['data'] as $script): ?>
<?php if ($script['type'] == 'file'): ?>
<script src="<?= $script['url']; ?>" type="text/javascript" charset="utf-8"></script>
<?php else: ?>
<script type="text/javascript" charset="utf-8">
	<?= $script['data']; ?>
</script>
<?php endif ?>
<?php endforeach ?>
