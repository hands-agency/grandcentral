<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>

<div class="wrapper">
	<span class="field">
		<ul>	
		<?php foreach ($fields as $field): ?>
			<li data-type="<?=$field->get_type()?>"><?= $field; ?></li>
		<?php endforeach ?>
		</ul>
	</span>
</div>
