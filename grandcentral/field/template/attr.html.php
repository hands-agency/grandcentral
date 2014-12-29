<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<? if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr(); ?></div><? endif ?>
	<div class="field">
		
		<ol class="data" data-nodata="Add an attribute to store data in this item. For instance, store a title, a description or a quantity."><?= $data; ?></ol>
		<ul class="add"><?= $addbuttons; ?></ul>

		<pre class="template">
			<? foreach ($template as $key => $html): ?>
			<div class="<?=$key?>"><?=$html?></div>
			<? endforeach ?>
		</pre>
		
	</div>
</div>