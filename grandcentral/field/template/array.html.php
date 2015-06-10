<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<input  type="hidden" name="<?= $_FIELD->get_name(); ?>" <?php if ($_FIELD->is_disabled()): ?>disabled="disabled" <?php endif ?>value="">
	<?php if (isset($hackToTextarea)): ?><div class="flat"><p>This array format has more than one level and is not currently supported for edition</p><pre><?= json_encode($_FIELD->get_value()) ?></pre></div><?php else : ?>
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr() ?></div><?php endif ?>
	<div class="field">
		
		<ol class="data" data-nodata="Add an array of parameters to refine your bunch of items."><?= $data; ?></ol>
		<ul class="add"><?= $addbuttons; ?></ul>

		<pre class="template">
			<?php foreach ($template as $key => $html): ?>
			<div class="<?=$key?>"><?=$html?></div>
			<?php endforeach ?>
		</pre>
		
		<?php endif ?>
	</div>
</div>