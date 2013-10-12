<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if (isset($hackToTextarea)): ?>This array format has more than one level and is not currently supported for edition<pre><?= json_encode($_FIELD->get_value()) ?></pre><?php else : ?>
	<? if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr() ?></div><? endif ?>
	<div class="field">
		
		<div class="nodata" <?= $hideNodata ?>>Add an array of parameters to refine your bunch of items.</div>
		<ol class="data"><?= $data; ?></ol>
		<ul class="add"><?= $addbuttons; ?></ul>

		<pre class="template">
			<? foreach ($template as $key => $html): ?>
			<div class="<?=$key?>"><?=$html?></div>
			<? endforeach ?>
		</pre>
		
		<?php endif ?>
	</div>
</div>