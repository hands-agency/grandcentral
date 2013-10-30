<?php foreach ($_ZONE['data'] as $css): ?>
<?php if ($css['type'] == 'file'):
	$file = new file($css['url']);
?>
<link rel="stylesheet" href="<?= $file->get_url(); ?>" type="text/css" charset="utf-8"><?php else: ?>
<style type="text/css" media="screen">
	<?= $css['data']; ?>
</style>
<?php endif ?>	
<?php endforeach ?>

