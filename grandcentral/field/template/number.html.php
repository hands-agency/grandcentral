<?php
	$field = $_PARAM['field'];
	
?>
<label for="<?= $field->get_name(); ?>">
	<?= $field->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if ($field->get_descr() != null) : ?><div class="help"><?= $field->get_descr(); ?></div><?php endif ?>
	<span class="field">
		<input<?=$field->get_attrs();?>>
		
	</span>
</div>