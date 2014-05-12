<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<? if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr() ?></div><? endif ?>
	<div class="field">
		
		<ol>
			<li><?= $fieldKey ?></li>
			<li><?= $fieldHttpStatus ?></li>
			<li><?= $fieldContentType ?></li>
			<li data-type="app"><?= $fieldApp ?></li>
			<li><?= $fieldUrl ?></li>
		</ol>
		
	</div>
</div>