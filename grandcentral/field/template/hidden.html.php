<?php foreach ($hiddens as $name => $value): ?>
	<input type="hidden" name="<?= $name; ?>" value="<?= $value; ?>">
<?php endforeach ?>