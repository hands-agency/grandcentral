<ol>
<?php foreach ($fields as $field) : ?>
	<li class="<?= $field->get_type(); ?>">
		<label for="<?= $field->get_name(); ?>"><?= $field->get_label(); ?><span class="help"></span></label>
		<? $field->set_label(''); ?>
		<div class="wrapper">
			<? if ($field->get_descr() != null) : ?><div class="help"><?= $field->get_descr(); ?></div><?php endif ?>
			<?= $field; ?>
		</div>
	</li>
<?php endforeach; ?>
</ol>