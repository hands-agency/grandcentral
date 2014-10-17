<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr(); ?></div><?php endif ?>
	<span class="field">
		<input type="hidden" class="datetime" name="<?= $_FIELD->get_name(); ?>" value="<?= $_FIELD->get_value(); ?>" />
		<input type="text" class="date" value="<?=$date?>" placeholder="Choose a day" />
		<input type="text" class="time" value="<?=$time?>" placeholder="and a time" />
	</span>
</div>