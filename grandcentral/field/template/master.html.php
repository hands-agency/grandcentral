<label>
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr(); ?></div><?php endif ?>
	<span class="field">
		<div class="fieldPageContainer" data-name="<?= $_FIELD->get_name(); ?>">
			<span class="fieldPageTypeSelect"><?= $field; ?></span>
			<span class="fieldPageTemplateSelect" data-value="<?= $template; ?>"></span>
		</div>
	</span>
</div>