<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<div class="field">
		<input type="hidden" name="<?= $_FIELD->get_name(); ?>" value="">
		<div class="nodata" <?= $hideNodata ?>>Add a role and an artist to this casting</div>
		<ol class="data"><?= $data; ?></ol>
		<ul class="add"><?= $addbuttons; ?></ul>
		<pre class="template">
			<?php foreach ($template as $key => $html): ?>
			<div class="<?=$key?>"><?=$html?></div>
			<?php endforeach ?>
		</pre>
	</div>
</div>
