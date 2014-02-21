<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<? if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr() ?></div><? endif ?>
	<div class="field">
		<select>
			<option>Content</option>
			<option>Feed</option>
			<option>Header</option>
		</select>
	</div>
</div>