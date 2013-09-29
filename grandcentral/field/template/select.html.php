<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr(); ?></div><?php endif ?>
	<span class="field">
		<select<?=$_FIELD->get_attrs();?>>
			<?php if (!empty($placeholder)) : ?>
				<option value=""><?=htmlspecialchars($placeholder);?></option>
			<?php endif; ?>
			<?php foreach ($values as $key => $value) : ?>
			<option value="<?=$value['id'];?>"<?= ($value['id'] == $_FIELD->get_value()) ? ' selected="selected"' : '' ?>><?=htmlspecialchars($value['title']);?></option>
			<?php endforeach; ?>
		</select>
	</span>
</div>