<?php if ($templates): ?>
<div class="template">
	<h1>Templates</h1>
	<?= $fieldTemplate; ?>
</div>
<?php endif ?>

<div class="param">
	<h1>Params</h1>
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
</div>

<button>⇠ Done</button>