<li data-type="<?= $field->get_type(); ?>" data-key="<?=$field->get_key(); ?>" class="editable">
	<div data-control="" class="icon-pencil"></div>
	<label for="<?= $field->get_name(); ?>"><?= $field->get_label(); ?></label><? $field->set_label(''); ?><div class="wrapper"><?= $field; ?><div class="help"></div></div>
</li>