<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr(); ?></div><?php endif ?>
	<span class="field">
		<input  type="hidden" name="<?= $_FIELD->get_name(); ?>" <?php if ($_FIELD->is_disabled()): ?>disabled="disabled"<?php endif ?>value="0">
		<input<?=$_FIELD->get_attrs();?>>
	</span>
</div>